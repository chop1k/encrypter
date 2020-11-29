<?php

namespace Encrypter\Command;

use Consolly\Argument\Argument;
use Consolly\Command\Command;
use Consolly\Exception\CommandException;
use Consolly\IO\Input\In;
use Consolly\IO\Output\Out;
use Encrypter\Exception\AlgorithmException;
use Encrypter\Exception\CryptoException;
use Encrypter\Exception\FileUnattainableException;
use Encrypter\Option\AlgorithmOption;
use Encrypter\Option\AvailableAlgorithmOption;
use Encrypter\Option\BinaryOption;
use Encrypter\Option\FileOption;
use Encrypter\Option\IVOption;
use Encrypter\Option\JsonKeyOption;
use Encrypter\Option\PasswordOption;
use Exception;
use InvalidArgumentException;
use JsonException;

class CryptoCommand extends Command
{

    public function getName(): string
    {
        return false;
    }

    protected PasswordOption $password;
    protected FileOption $file;
    protected AlgorithmOption $algorithm;
    protected AvailableAlgorithmOption $available;
    protected IVOption $iv;
    protected BinaryOption $binary;
    protected JsonKeyOption $jsonKey;

    public function getOptions(): array
    {
        return [
            $this->password,
            $this->file,
            $this->algorithm,
            $this->available,
            $this->iv,
            $this->binary,
            $this->jsonKey
        ];
    }

    public function __construct()
    {
        $this->password = new PasswordOption();
        $this->file = new FileOption();

        $this->algorithm = new AlgorithmOption();

        $this->algorithm->setRequired(false);

        $this->available = new AvailableAlgorithmOption();
        $this->iv = new IVOption();
        $this->binary = new BinaryOption();
        $this->jsonKey = new JsonKeyOption();
    }

    protected function getPassword(): string
    {
        $password = null;

        if ($this->password->isIndicated())
        {
            $password = $this->password->getValue();
        }

        if (is_null($password))
        {
            $password = readline('Password: ');

            if ($password === false)
            {
                throw new Exception("password is required");
            }
        }

        if (is_null($password))
        {
            throw new CommandException('Password not specified. Use -p for specifying password');
        }

        return $password;
    }

    protected function getIV(): string
    {
        $iv = null;

        if ($this->iv->isIndicated())
        {
            $iv = $this->iv->getValue();
        }

        if (is_null($iv))
        {
            $iv = readline('IV: ');

            if ($iv === false)
            {
                throw new Exception('IV is required');
            }
        }

        if (is_null($iv))
        {
            throw new CommandException('IV not specified. Use -i for specifying iv');
        }

        return hash('md5', $iv, true);
    }

    protected function getData(array $args): string
    {
        if ($this->file->isIndicated())
        {
            $data = file_get_contents($this->file->getValue());

            if ($data === false)
            {
                throw new FileUnattainableException(sprintf('cannot read file "%s"', $this->file->getValue()));
            }

            return $data;
        }

        if (isset($args[0]))
        {
            /**
             * @var Argument $arg
             */
            $arg = $args[0];

            if ($arg->getType() < 200 && $arg->getType() > 300)
            {
                throw new InvalidArgumentException('First argument of hash command must be value type.');
            }

            return $arg->getValue();
        }

        $in = In::read();

        if ($in != false)
        {
            return $in;
        }

        throw new InvalidArgumentException('Value isn\'t specified');
    }

    protected function getAlgosString(): string
    {
        return sprintf('Available algorithms: %s', implode(", ", openssl_get_cipher_methods()));
    }

    public function handle(array $nextArgs): void
    {
        if ($this->available->isIndicated())
        {
            Out::write($this->getAlgosString());

            return;
        }

        if (!in_array($this->algorithm->getValue(), openssl_get_cipher_methods()))
        {
            throw new AlgorithmException('Algorithm not supported');
        }
    }

    protected function crypt(bool $decrypt, string $algorithm, string $data, string $password, string $iv, bool $binary = false): string
    {
        $result = !$decrypt
            ? openssl_encrypt($data, $algorithm, $password, $binary ? OPENSSL_RAW_DATA : 0, $iv)
            : openssl_decrypt($data, $algorithm, $password, $binary ? OPENSSL_RAW_DATA : 0, $iv);

        if ($result === false)
        {
            throw new CryptoException(sprintf('Cannot %s given data', $decrypt ? 'decrypt' : 'encrypt'));
        }

        if ($this->jsonKey->isIndicated())
        {
            $json = json_decode($result);

            $key = $this->jsonKey->getValue();

            if (!isset($json->$key))
            {
                throw new JsonException(sprintf('Json not contains key "%s"', $key));
            }

            $result = $json->$key;

            if (!is_string($result))
            {
                $result = json_encode($result);
            }
        }

        return $result;
    }
}
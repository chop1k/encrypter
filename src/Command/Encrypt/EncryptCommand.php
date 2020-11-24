<?php

namespace Encrypter\Command\Hash\Encrypt;

use Consolly\Argument\Argument;
use Consolly\Command\Command;
use Consolly\IO\Input\In;
use Consolly\IO\Output\Out;
use Encrypter\Exception\AlgorithmException;
use Encrypter\Exception\EncryptionException;
use Encrypter\Exception\FileUnattainableException;
use Encrypter\Option\AlgorithmOption;
use Encrypter\Option\AvailableAlgorithmOption;
use Encrypter\Option\FileOption;
use Encrypter\Option\PasswordOption;
use InvalidArgumentException;

class EncryptCommand extends Command
{

    public function getName(): string
    {
        return "encrypt";
    }

    private PasswordOption $password;
    private FileOption $file;
    private AlgorithmOption $algorithm;
    private AvailableAlgorithmOption $available;

    public function getOptions(): array
    {
        return [
            $this->password,
            $this->file,
            $this->algorithm,
            $this->available
        ];
    }

    public function __construct()
    {
        $this->password = new PasswordOption();
        $this->file = new FileOption();

        $this->algorithm = new AlgorithmOption();

        $this->algorithm->setRequired(false);

        $this->available = new AvailableAlgorithmOption();
    }

    private function getPassword(): string
    {
        $password = null;

        if ($this->password->isIndicated())
        {
            $password = $this->password->getValue();
        }

        if (is_null($password))
        {
            $password = readline('Password:');

            if ($password === false)
            {
                throw new \Exception("password is required");
            }
        }

        return $this->password->getValue();
    }

    private function getData(array $args): string
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

        throw new InvalidArgumentException('Value for encryption isn\'t specified');
    }

    public function handle(array $nextArgs): void
    {
        if ($this->available->isIndicated())
        {
            Out::write(sprintf('Available algorithms: %s', implode(", ", openssl_get_cipher_methods())));

            return;
        }

        $password = $this->getPassword();

        $data = $this->getData($nextArgs);

        $algorithm = $this->algorithm->getValue();

        if (!in_array($algorithm, openssl_get_cipher_methods()))
        {
            throw new AlgorithmException('Algorithm not supported');
        }

        $result = openssl_encrypt($data, $algorithm, $password);

        if ($result === false)
        {
            throw new EncryptionException('Cannot encrypt given data');
        }

        Out::write($result);
    }
}
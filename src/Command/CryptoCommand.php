<?php

namespace Encrypter\Command;

use Consolly\Exception\CommandException;
use Consolly\IO\Exception\OutException;
use Consolly\IO\Output\Out;
use Encrypter\Exception\AlgorithmException;
use Encrypter\Exception\CryptoException;
use Encrypter\Exception\FileUnattainableException;
use Encrypter\Option\AlgorithmOption;
use Encrypter\Option\AvailableAlgorithmOption;
use Encrypter\Option\BinaryOption;
use Encrypter\Option\IVOption;
use Encrypter\Option\JsonKeyOption;
use Encrypter\Option\PasswordOption;
use Exception;

/**
 * Class CryptoCommand represents base class for encryption/decryption commands.
 *
 * @package Encrypter\Command
 */
class CryptoCommand extends BaseCommand
{
    /**
     * Password option.
     *
     * @var PasswordOption $password
     */
    protected PasswordOption $password;

    /**
     * Required option that specifies encryption algorithm.
     *
     * @var AlgorithmOption $algorithm
     */
    protected AlgorithmOption $algorithm;

    /**
     * If indicated returns list of all available algorithms.
     *
     * @var AvailableAlgorithmOption $available
     */
    protected AvailableAlgorithmOption $available;

    /**
     * Option that specifies initial vector.
     *
     * @var IVOption $iv
     */
    protected IVOption $iv;

    /**
     * Option that specifies in what form result will be displayed.
     *
     * @var BinaryOption $binary
     */
    protected BinaryOption $binary;

    /**
     * JsonKey option.
     *
     * @var JsonKeyOption $jsonKey
     */
    protected JsonKeyOption $jsonKey;

    /**
     * CryptoCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->name = false;

        $this->password = new PasswordOption();

        $this->algorithm = new AlgorithmOption();

        $this->algorithm->setRequired(true);

        $this->available = new AvailableAlgorithmOption();
        $this->iv = new IVOption();
        $this->binary = new BinaryOption();
        $this->jsonKey = new JsonKeyOption();

        $this->options = [
            $this->password,
            $this->file,
            $this->output,
            $this->algorithm,
            $this->available,
            $this->iv,
            $this->binary,
            $this->jsonKey
        ];
    }

    /**
     * Returns password.
     *
     * @return string
     *
     * @throws CommandException
     *
     * @throws Exception
     */
    protected function getPassword(): string
    {
        $password = null;

        if ($this->password->isIndicated()) {
            $password = $this->password->getValue();
        }

        if (is_null($password)) {
            $password = readline('Password: ');

            if ($password === false) {
                throw new Exception("Password is required. ");
            }
        }

        if (is_null($password)) {
            throw new CommandException('Password not specified. Use -p for specifying password. ');
        }

        return $password;
    }

    /**
     * Returns initial vector.
     *
     * @return string
     *
     * @throws CommandException
     *
     * @throws Exception
     */
    protected function getIV(): string
    {
        $iv = null;

        if ($this->iv->isIndicated()) {
            $iv = $this->iv->getValue();
        }

        if (is_null($iv)) {
            $iv = readline('IV: ');

            if ($iv === false) {
                throw new Exception('IV is required. ');
            }
        }

        if (is_null($iv)) {
            throw new CommandException('IV not specified. Use -i for specifying iv. ');
        }

        return hash('md5', $iv, true);
    }

    /**
     * Returns string with available algorithms.
     *
     * @return string
     */
    protected function getAlgosString(): string
    {
        return sprintf('Available algorithms: %s. ', implode(", ", openssl_get_cipher_methods()));
    }

    /**
     * @inheritdoc
     *
     * @param array $nextArgs
     *
     * @throws AlgorithmException
     */
    public function handle(array $nextArgs): void
    {
        if (!in_array($this->algorithm->getValue(), openssl_get_cipher_methods())) {
            throw new AlgorithmException('Algorithm not supported. ');
        }
    }

    /**
     * Writes algos string to stdout and returns true.
     *
     * @return bool
     *
     * @throws OutException
     */
    protected function writeAvailableAlgos(): bool
    {
        if ($this->available->isIndicated()) {
            Out::log($this->getAlgosString());

            return true;
        }

        return false;
    }

    /**
     * Shortcut for writing data to the file if specified, to the stdout otherwise.
     *
     * @param string $data
     *
     * @throws FileUnattainableException
     *
     * @throws OutException
     */
    protected function write(string $data): void
    {
        if ($this->output->isIndicated()) {
            $result = file_put_contents($this->output->getValue(), $data);

            if ($result === false) {
                throw new FileUnattainableException(
                    sprintf('Cannot write to the file "%s". ', $this->file->getValue())
                );
            }
        } else {
            Out::log($data);
        }
    }

    /**
     * Encrypts/decrypts given data and returns result.
     *
     * @param bool $decrypt
     *
     * @param string $algorithm
     *
     * @param string $data
     *
     * @param string $password
     *
     * @param string $iv
     *
     * @param bool $binary
     *
     * @return string
     *
     * @throws CryptoException
     *
     */
    protected function crypt(
        bool $decrypt,
        string $algorithm,
        string $data,
        string $password,
        string $iv,
        bool $binary = false
    ): string {
        $result = !$decrypt
            ? openssl_encrypt($data, $algorithm, $password, $binary ? OPENSSL_RAW_DATA : 0, $iv)
            : openssl_decrypt($data, $algorithm, $password, $binary ? OPENSSL_RAW_DATA : 0, $iv);

        if ($result === false) {
            throw new CryptoException(sprintf('Cannot %s given data. ', $decrypt ? 'decrypt' : 'encrypt'));
        }

        return $result;
    }
}

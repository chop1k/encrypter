<?php

namespace Encrypter\Command;

use Consolly\Command\Command;
use Consolly\IO\Output\Out;
use Encrypter\Exception\AlgorithmException;
use Encrypter\Exception\EncryptionException;
use Encrypter\Option\AlgorithmOption;
use Encrypter\Option\AvailableAlgorithmOption;
use Encrypter\Option\FileOption;
use Encrypter\Option\PasswordOption;

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

        return $this->password;
    }

    private function getData(array $args): string
    {

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

        if (!in_array($this->algorithm->getValue(), openssl_get_cipher_methods()))
        {
            throw new AlgorithmException('Algorithm not supported');
        }

        $result = openssl_encrypt();

        if ($result === false)
        {
            throw new EncryptionException('Cannot encrypt given data');
        }

        Out::write($result);
    }
}
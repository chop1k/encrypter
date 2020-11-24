<?php

namespace Encrypter\Command\Decrypt;

use Consolly\Command\Command;
use Consolly\IO\Output\Out;
use Encrypter\Command\CryptoCommand;
use Encrypter\Option\AlgorithmOption;
use Encrypter\Option\AvailableAlgorithmOption;
use Encrypter\Option\FileOption;
use Encrypter\Option\PasswordOption;

class DecryptCommand extends CryptoCommand
{
    public function getName(): string
    {
        return 'decrypt';
    }

    public function handle(array $nextArgs): void
    {
        parent::handle($nextArgs);

        Out::write(
            $this->crypt(
                true,
                $this->algorithm->getValue(),
                $this->getData($nextArgs),
                $this->getPassword(),
                $this->iv->getValue(),
                $this->binary->isIndicated()
            )
        );
    }
}
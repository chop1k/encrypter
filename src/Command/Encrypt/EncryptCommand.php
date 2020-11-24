<?php

namespace Encrypter\Command\Encrypt;

use Consolly\IO\Output\Out;
use Encrypter\Command\CryptoCommand;

class EncryptCommand extends CryptoCommand
{

    public function getName(): string
    {
        return 'encrypt';
    }

    public function handle(array $nextArgs): void
    {
        parent::handle($nextArgs);

        Out::write(
            $this->crypt(
                false,
                $this->algorithm->getValue(),
                $this->getData($nextArgs),
                $this->getPassword(),
                $this->iv->getValue(),
                $this->binary->isIndicated()
            )
        );
    }
}
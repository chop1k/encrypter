<?php

namespace Encrypter\Command\Decrypt;

use Consolly\IO\Output\Out;
use Encrypter\Command\CryptoCommand;

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
                $this->getIV(),
                $this->binary->isIndicated()
            )
        );
    }
}
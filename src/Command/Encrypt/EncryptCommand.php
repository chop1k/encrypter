<?php

namespace Encrypter\Command\Encrypt;

use Consolly\Exception\CommandException;
use Consolly\IO\Exception\InputException;
use Consolly\IO\Exception\OutException;
use Encrypter\Command\CryptoCommand;
use Encrypter\Exception\AlgorithmException;
use Encrypter\Exception\CryptoException;
use Encrypter\Exception\FileUnattainableException;

/**
 * Class EncryptCommand represents encrypt command.
 *
 * @package Encrypter\Command\Encrypt
 */
class EncryptCommand extends CryptoCommand
{

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'encrypt';
    }

    /**
     * @inheritdoc
     *
     * @throws CommandException
     *
     * @throws InputException
     *
     * @throws OutException
     *
     * @throws AlgorithmException
     *
     * @throws CryptoException
     *
     * @throws FileUnattainableException
     *
     */
    public function handle(array $nextArgs): void
    {
        if ($this->writeAvailableAlgos()) {
            return;
        }

        parent::handle($nextArgs);

        $this->write(
            $this->crypt(
                false,
                $this->algorithm->getValue(),
                $this->getData($nextArgs),
                $this->getPassword(),
                $this->getIV(),
                $this->binary->isIndicated()
            )
        );
    }
}

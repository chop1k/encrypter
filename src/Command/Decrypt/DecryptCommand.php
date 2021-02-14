<?php

namespace Encrypter\Command\Decrypt;

use Consolly\Exception\CommandException;
use Consolly\IO\Exception\InputException;
use Consolly\IO\Exception\OutException;
use Encrypter\Command\CryptoCommand;
use Encrypter\Exception\AlgorithmException;
use Encrypter\Exception\CryptoException;
use Encrypter\Exception\FileUnattainableException;

/**
 * Class DecryptCommand represents decrypt command.
 *
 * @package Encrypter\Command\Decrypt
 */
class DecryptCommand extends CryptoCommand
{
    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'decrypt';
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

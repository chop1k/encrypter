<?php

namespace Encrypter\Command\Decrypt;

use Consolly\Exception\CommandException;
use Consolly\IO\Exception\InputException;
use Consolly\IO\Exception\OutException;
use Encrypter\Exception\CryptoException;
use Encrypter\Exception\FileUnattainableException;
use JsonException;

/**
 * Class DecryptJsonCommand represents decrypt command which works with json.
 *
 * @package Encrypter\Command\Decrypt
 */
class DecryptJsonCommand extends DecryptCommand
{
    /**
     * DecryptJsonCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->name = 'decrypt-json';

        $this->jsonKey->setRequired(true);
    }

    /**
     * @inheritdoc
     *
     * @param array $nextArgs
     *
     * @throws JsonException
     *
     * @throws CommandException
     *
     * @throws InputException
     *
     * @throws OutException
     *
     * @throws CryptoException
     *
     * @throws FileUnattainableException
     *
     */
    public function handle(array $nextArgs): void
    {
        $json = json_decode($this->crypt(
            true,
            $this->algorithm->getValue(),
            $this->getData($nextArgs),
            $this->getPassword(),
            $this->getIV(),
            $this->binary->isIndicated()
        ), true);

        if (is_null($json)) {
            throw new JsonException('Cannot parse given data. ');
        }

        $key = $this->jsonKey->getValue();

        if (!isset($json[$key])) {
            throw new JsonException(sprintf('Json does not contains key "%s". ', $key));
        }

        $this->write($json[$key]);
    }
}

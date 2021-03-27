<?php

namespace Encrypter\Command\Encrypt;

use Consolly\Exception\CommandException;
use Consolly\IO\Exception\InputException;
use Consolly\IO\Exception\OutException;
use Encrypter\Exception\CryptoException;
use Encrypter\Exception\FileUnattainableException;
use Exception;
use JsonException;

/**
 * Class EncryptJsonCommand represents encrypt command which works with json.
 *
 * @package Encrypter\Command\Encrypt
 */
class EncryptJsonCommand extends EncryptCommand
{
    /**
     * EncryptJsonCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->jsonKey->setRequired(true);
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'encrypt-json';
    }

    /**
     * Returns json key and value.
     *
     * @return array
     * First element of returned array is key name.
     * Second element of returned array is key value.
     *
     * @throws Exception
     */
    protected function getKey(): array
    {
        $value = readline('Key value: ');

        if ($value === false) {
            throw new Exception('Key value not specified.');
        }

        return [
            $this->jsonKey->getValue(),
            $value
        ];
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
     * @throws Exception
     */
    public function handle(array $nextArgs): void
    {
        $password = $this->getPassword();
        $iv = $this->getIV();
        $algorithm = $this->algorithm->getValue();
        $binary = $this->binary->isIndicated();

        $json = json_decode($this->crypt(
            true,
            $algorithm,
            $this->getData($nextArgs),
            $password,
            $iv,
            $binary
        ), true);

        if (is_null($json)) {
            throw new JsonException('Cannot parse given data.');
        }

        [ $name, $value ] = $this->getKey();

        if ($value === 'null' && isset($json[$name])) {
            unset($json[$name]);
        } else {
            $json[$name] = $value;
        }

        $this->write(
            $this->crypt(
                false,
                $algorithm,
                json_encode($json),
                $password,
                $iv,
                $binary
            )
        );
    }
}

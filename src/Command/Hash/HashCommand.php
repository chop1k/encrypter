<?php

namespace Encrypter\Command\Hash;

use Consolly\IO\Exception\InputException;
use Consolly\IO\Exception\OutException;
use Consolly\IO\Output\Out;
use Encrypter\Command\BaseCommand;
use Encrypter\Exception\FileUnattainableException;
use Encrypter\Option\AlgorithmOption;
use Encrypter\Option\AvailableAlgorithmOption;
use Encrypter\Option\BinaryOption;
use Encrypter\Option\SaltOption;

/**
 * Class HashCommand represents hashing command.
 *
 * @package Encrypter\Command\Hash
 */
class HashCommand extends BaseCommand
{

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return "hash";
    }

    /**
     * Option that specifies encryption algorithm. Default value = sha256.
     *
     * @var AlgorithmOption $algorithm
     */
    private AlgorithmOption $algorithm;

    /**
     * Option that specifies in what form hash will be displayed. If indicated then the hash will be returned in binary.
     *
     * @var BinaryOption $binary
     */
    private BinaryOption $binary;

    /**
     * Option that specifies salt. Salt is a text which adds to the main text.
     *
     * @var SaltOption $salt
     */
    private SaltOption $salt;

    /**
     * Returns list of all available hashing algorithms.
     *
     * @var AvailableAlgorithmOption $available
     */
    private AvailableAlgorithmOption $available;

    /**
     * @inheritDoc
     */
    public function getOptions(): array
    {
        return [
            $this->algorithm,
            $this->file,
            $this->output,
            $this->binary,
            $this->salt,
            $this->available
        ];
    }

    /**
     * HashCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->algorithm = new AlgorithmOption();

        $this->algorithm->setValue("sha256");

        $this->binary = new BinaryOption();
        $this->salt = new SaltOption();
        $this->available = new AvailableAlgorithmOption();
    }

    /**
     * @inheritdoc
     *
     * @throws FileUnattainableException
     *
     * @throws InputException
     *
     * @throws OutException
     */
    public function handle(array $nextArgs): void
    {
        if ($this->available->isIndicated()) {
            Out::write(sprintf('Available hash algorithms: %s', implode(", ", hash_algos())));
        } else {
            $data = $this->getData($nextArgs);

            Out::write(
                hash($this->algorithm->getValue() . $this->salt->getValue(), $data, $this->binary->isIndicated())
            );
        }
    }
}

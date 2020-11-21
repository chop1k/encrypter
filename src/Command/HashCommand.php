<?php

namespace Encrypter\Command;

use Consolly\Argument\Argument;
use Consolly\Command\Command;
use Consolly\IO\Input\In;
use Consolly\IO\Output\Out;
use Encrypter\Exception\FileUnattainableException;
use Encrypter\Option\AlgorithmOption;
use Encrypter\Option\AvailableAlgorithmOption;
use Encrypter\Option\BinaryOption;
use Encrypter\Option\FileOption;
use Encrypter\Option\SaltOption;
use InvalidArgumentException;

class HashCommand extends Command
{

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return "hash";
    }

    private AlgorithmOption $algorithm;
    private FileOption $file;
    private BinaryOption $binary;
    private SaltOption $salt;
    private AvailableAlgorithmOption $available;

    /**
     * @inheritDoc
     */
    public function getOptions(): array
    {
        return [
            $this->algorithm,
            $this->file,
            $this->binary,
            $this->salt,
            $this->available
        ];
    }

    public function __construct()
    {
        $this->algorithm = new AlgorithmOption();

        $this->algorithm->setValue("sha256");

        $this->file = new FileOption();
        $this->binary = new BinaryOption();
        $this->salt = new SaltOption();
        $this->available = new AvailableAlgorithmOption();
    }

    private function getData(array $args): string
    {
        if ($this->file->isIndicated())
        {
            $data = file_get_contents($this->file->getValue());

            if ($data === false)
            {
                throw new FileUnattainableException(sprintf('cannot read file "%s"', $this->file->getValue()));
            }

            return $data;
        }

        if (isset($args[1]))
        {
            /**
             * @var Argument $arg
             */
            $arg = $args[1];

            if ($arg->getType() < 200 && $arg->getType() > 300)
            {
                throw new InvalidArgumentException('First argument of hash command must be value type.');
            }

            return $arg->getValue();
        }

        $in = In::read();

        if ($in != false)
        {
            return $in;
        }

        throw new InvalidArgumentException('Value for hashing isn\'t specified');
    }

    /**
     * @inheritDoc
     */
    public function handle(array $nextArgs): void
    {
        if ($this->available->isIndicated())
        {
            Out::write(sprintf('Available hash algorithms: %s', implode(", ", hash_algos())));

            return;
        }

        $data = $this->getData($nextArgs);

        Out::write(hash($this->algorithm->getValue() . $this->salt->getValue(), $data, $this->binary->isIndicated()));
    }
}
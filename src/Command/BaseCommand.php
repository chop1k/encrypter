<?php

namespace Encrypter\Command;

use Consolly\Argument\Argument;
use Consolly\Command\Command;
use Consolly\IO\Exception\InputException;
use Consolly\IO\Input\In;
use Encrypter\Exception\FileUnattainableException;
use Encrypter\Option\FileOption;
use Encrypter\Option\OutputFile;
use InvalidArgumentException;

/**
 * Class BaseCommand represents class with general functionality.
 *
 * @package Encrypter\Command
 */
class BaseCommand extends Command
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return false;
    }

    /**
     * File option. Specifies the file whose data will be used.
     *
     * @var FileOption $file
     */
    protected FileOption $file;

    /**
     * OutputFile option. Specifies the file to which the data will be written.
     *
     * @var OutputFile $output
     */
    protected OutputFile $output;

    /**
     * @inheritDoc
     */
    public function getOptions(): array
    {
        return [];
    }

    /**
     * BaseCommand constructor.
     */
    public function __construct()
    {
        $this->file = new FileOption();
        $this->output = new OutputFile();
    }

    /**
     * @inheritDoc
     */
    public function handle(array $nextArgs): void
    {
    }

    /**
     * Returns data.
     *
     * @param array $args
     *
     * @return string
     *
     * @throws FileUnattainableException
     *
     * @throws InputException
     */
    protected function getData(array $args): string
    {
        if ($this->file->isIndicated()) {
            $data = file_get_contents($this->file->getValue());

            if ($data === false) {
                throw new FileUnattainableException(sprintf('Cannot read file "%s".', $this->file->getValue()));
            }

            return $data;
        }

        if (isset($args[0])) {
            /**
             * @var Argument $arg
             */
            $arg = $args[0];

            if ($arg->getType() < 200 && $arg->getType() > 300) {
                throw new InvalidArgumentException('First argument of hash command must be value type.');
            }

            return $arg->getValue();
        }

        $in = In::read();

        if ($in != false) {
            return $in;
        }

        throw new InvalidArgumentException('Value isn`t specified.');
    }
}

<?php

namespace Encrypter\Command;

use Consolly\Command\Command;
use Consolly\Helper\Argument;
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
     * BaseCommand constructor.
     */
    public function __construct()
    {
        $this->name = false;

        $this->options = [];

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
                throw new FileUnattainableException(sprintf('Cannot read file "%s". ', $this->file->getValue()));
            }

            return $data;
        }

        if (isset($args[0])) {
            $arg = $args[0];

            if (Argument::isValue($arg)) {
                return Argument::toValue($arg);
            }

            if (Argument::isPureValue($arg)) {
                return Argument::toPureValue($arg);
            }

            throw new InvalidArgumentException('First argument of the hash command must be a value type. ');
        }

        $in = In::read();

        if ($in != false) {
            return $in;
        }

        throw new InvalidArgumentException('Value isn`t specified. ');
    }
}

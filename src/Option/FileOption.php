<?php

namespace Encrypter\Option;

use Consolly\Option\Option;
use Encrypter\Exception\FileUnattainableException;

/**
 * Class FileOption specifies the file whose data will be used.
 *
 * @package Encrypter\Option
 */
class FileOption extends Option
{
    /**
     * @inheritDoc
     *
     * @throws FileUnattainableException
     */
    public function setValue($value): void
    {
        if (!is_file($value)) {
            throw new FileUnattainableException("Value of option '--file' isn't a path to file or file not found.");
        }

        $this->value = $value;
    }

    /**
     * FileOption constructor.
     */
    public function __construct()
    {
        $this->name = 'file';
        $this->abbreviation = 'f';
        $this->required = false;
        $this->requiresValue = true;
        $this->indicated = false;
        $this->value = false;
    }
}

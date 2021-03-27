<?php

namespace Encrypter\Option;

use Consolly\Option\Option;

/**
 * Class OutputFile specifies the file to which the data will be written.
 *
 * @package Encrypter\Option
 */
class OutputFile extends Option
{
    /**
     * OutputFile constructor.
     */
    public function __construct()
    {
        $this->name = 'output-file';
        $this->abbreviation = 'O';
        $this->required = false;
        $this->requiresValue = true;
        $this->value = false;
        $this->indicated = false;
    }
}

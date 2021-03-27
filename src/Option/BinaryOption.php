<?php

namespace Encrypter\Option;

use Consolly\Option\Option;

/**
 * Class BinaryOption specifies in what form result will be displayed.
 *
 * @package Encrypter\Option
 */
class BinaryOption extends Option
{
    /**
     * BinaryOption constructor.
     */
    public function __construct()
    {
        $this->name = 'binary';
        $this->abbreviation = 'b';
        $this->required = false;
        $this->requiresValue = false;
        $this->indicated = false;
        $this->value = false;
    }
}

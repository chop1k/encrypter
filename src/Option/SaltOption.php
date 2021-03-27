<?php

namespace Encrypter\Option;

use Consolly\Option\Option;

/**
 * Class SaltOption is a option that specifies salt. Salt is a text which adds to the main text.
 *
 * @package Encrypter\Option
 */
class SaltOption extends Option
{
    /**
     * SaltOption constructor.
     */
    public function __construct()
    {
        $this->name = 'salt';
        $this->abbreviation = 's';
        $this->required = false;
        $this->requiresValue = true;
        $this->value = false;
        $this->indicated = false;
    }
}

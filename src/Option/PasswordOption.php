<?php

namespace Encrypter\Option;

use Consolly\Option\Option;

/**
 * Class PasswordOption is a option that specifies password for encryption.
 *
 * @package Encrypter\Option
 */
class PasswordOption extends Option
{
    /**
     * PasswordOption constructor.
     */
    public function __construct()
    {
        $this->name = 'password';
        $this->abbreviation = 'p';
        $this->requiresValue = true;
        $this->required = false;
        $this->indicated = false;
        $this->value = false;
    }
}

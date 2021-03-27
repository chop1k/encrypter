<?php

namespace Encrypter\Option;

use Consolly\Option\Option;

/**
 * Class IVOption is a option that specifies initial vector.
 *
 * @package Encrypter\Option
 */
class IVOption extends Option
{
    /**
     * IVOption constructor.
     */
    public function __construct()
    {
        $this->name = 'iv';
        $this->abbreviation = 'i';
        $this->requiresValue = true;
        $this->required = false;
        $this->indicated = false;
        $this->value = false;
    }
}

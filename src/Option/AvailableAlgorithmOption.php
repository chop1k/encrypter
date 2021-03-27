<?php

namespace Encrypter\Option;

use Consolly\Option\Option;

/**
 * Class AvailableAlgorithmOption is a option which returns list of all available hashing algorithms.
 *
 * @package Encrypter\Option
 */
class AvailableAlgorithmOption extends Option
{
    /**
     * AvailableAlgorithmOption constructor.
     */
    public function __construct()
    {
        $this->name = 'available';
        $this->abbreviation = 'A';
        $this->requiresValue = false;
        $this->required = false;
        $this->indicated = false;
        $this->value = false;
    }
}

<?php

namespace Encrypter\Option;

use Consolly\Option\Option;

/**
 * Class AlgorithmOption is a option that specifies algorithm.
 *
 * @package Encrypter\Option
 */
class AlgorithmOption extends Option
{
    /**
     * AlgorithmOption constructor.
     */
    public function __construct()
    {
        $this->name = 'algorithm';
        $this->abbreviation = 'a';
        $this->requiresValue = true;
        $this->required = false;
        $this->indicated = false;
        $this->value = false;
    }
}

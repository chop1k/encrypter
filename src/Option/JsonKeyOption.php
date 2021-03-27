<?php

namespace Encrypter\Option;

use Consolly\Option\Option;

/**
 * Class JsonKeyOption is a JsonKey option.
 *
 * @package Encrypter\Option
 */
class JsonKeyOption extends Option
{
    /**
     * JsonKeyOption constructor.
     */
    public function __construct()
    {
        $this->name = 'json-key';
        $this->abbreviation = 'k';
        $this->requiresValue = true;
        $this->required = false;
        $this->indicated = false;
        $this->value = false;
    }
}

<?php

namespace Encrypter\Option;

/**
 * Class PasswordOption is a option that specifies password for encryption.
 *
 * @package Encrypter\Option
 */
class PasswordOption extends BaseOption
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return "password";
    }

    /**
     * @inheritDoc
     */
    public function getAbbreviation(): ?string
    {
        return "p";
    }

    /**
     * PasswordOption constructor.
     */
    public function __construct()
    {
        $this->requiresValue = true;
        $this->required = false;
        $this->indicated = false;
        $this->value = false;
    }
}
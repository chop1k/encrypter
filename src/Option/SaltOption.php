<?php

namespace Encrypter\Option;

/**
 * Class SaltOption is a option that specifies salt. Salt is a text which adds to the main text.
 *
 * @package Encrypter\Option
 */
class SaltOption extends BaseOption
{

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'salt';
    }

    /**
     * @inheritDoc
     */
    public function getAbbreviation(): ?string
    {
        return 's';
    }

    /**
     * SaltOption constructor.
     */
    public function __construct()
    {
        $this->required = false;
        $this->requiresValue = true;
        $this->value = false;
        $this->indicated = false;
    }
}
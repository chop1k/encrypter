<?php

namespace Encrypter\Option;

/**
 * Class IVOption is a option that specifies initial vector.
 *
 * @package Encrypter\Option
 */
class IVOption extends BaseOption
{

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'iv';
    }

    /**
     * @inheritDoc
     */
    public function getAbbreviation(): ?string
    {
        return 'i';
    }

    /**
     * IVOption constructor.
     */
    public function __construct()
    {
        $this->requiresValue = true;
        $this->required = false;
        $this->indicated = false;
        $this->value = false;
    }
}
<?php

namespace Encrypter\Option;

/**
 * Class BinaryOption specifies in what form result will be displayed.
 *
 * @package Encrypter\Option
 */
class BinaryOption extends BaseOption
{

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return "binary";
    }

    /**
     * @inheritDoc
     */
    public function getAbbreviation(): ?string
    {
        return "b";
    }

    /**
     * BinaryOption constructor.
     */
    public function __construct()
    {
        $this->required = false;
        $this->requiresValue = false;
        $this->indicated = false;
        $this->value = false;
    }
}

<?php

namespace Encrypter\Option;

/**
 * Class AvailableAlgorithmOption is a option which returns list of all available hashing algorithms.
 *
 * @package Encrypter\Option
 */
class AvailableAlgorithmOption extends BaseOption
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'available';
    }

    /**
     * @inheritDoc
     */
    public function getAbbreviation(): ?string
    {
        return 'A';
    }

    /**
     * AvailableAlgorithmOption constructor.
     */
    public function __construct()
    {
        $this->requiresValue = false;
        $this->required = false;
        $this->indicated = false;
        $this->value = false;
    }
}
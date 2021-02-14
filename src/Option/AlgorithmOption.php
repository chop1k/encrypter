<?php

namespace Encrypter\Option;

/**
 * Class AlgorithmOption is a option that specifies algorithm.
 *
 * @package Encrypter\Option
 */
class AlgorithmOption extends BaseOption
{

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return "algorithm";
    }

    /**
     * @inheritDoc
     */
    public function getAbbreviation(): ?string
    {
        return "a";
    }

    /**
     * AlgorithmOption constructor.
     */
    public function __construct()
    {
        $this->requiresValue = true;
        $this->required = false;
        $this->indicated = false;
        $this->value = false;
    }
}

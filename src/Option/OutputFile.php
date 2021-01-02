<?php

namespace Encrypter\Option;

/**
 * Class OutputFile specifies the file to which the data will be written.
 *
 * @package Encrypter\Option
 */
class OutputFile extends BaseOption
{
    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'output-file';
    }

    /**
     * @inheritdoc
     */
    public function getAbbreviation(): ?string
    {
        return 'O';
    }

    /**
     * OutputFile constructor.
     */
    public function __construct()
    {
        $this->required = false;
        $this->requiresValue = true;
        $this->value = false;
        $this->indicated = false;
    }
}
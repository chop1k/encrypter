<?php

namespace Encrypter\Option;

/**
 * Class JsonKeyOption is a JsonKey option.
 *
 * @package Encrypter\Option
 */
class JsonKeyOption extends BaseOption
{

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'json-key';
    }

    /**
     * @inheritDoc
     */
    public function getAbbreviation(): ?string
    {
        return 'k';
    }

    /**
     * JsonKeyOption constructor.
     */
    public function __construct()
    {
        $this->requiresValue = true;
        $this->required = false;
        $this->indicated = false;
        $this->value = false;
    }
}

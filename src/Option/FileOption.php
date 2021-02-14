<?php

namespace Encrypter\Option;

use Encrypter\Exception\FileUnattainableException;

/**
 * Class FileOption specifies the file whose data will be used.
 *
 * @package Encrypter\Option
 */
class FileOption extends BaseOption
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'file';
    }

    /**
     * @inheritDoc
     */
    public function getAbbreviation(): ?string
    {
        return 'f';
    }

    /**
     * @inheritDoc
     *
     * @throws FileUnattainableException
     */
    public function setValue(string $value): void
    {
        if (!is_file($value)) {
            throw new FileUnattainableException("Value of option '--file' isn't a path to file or file not found.");
        }

        $this->value = $value;
    }

    /**
     * FileOption constructor.
     */
    public function __construct()
    {
        $this->required = false;
        $this->requiresValue = true;
        $this->indicated = false;
        $this->value = false;
    }
}

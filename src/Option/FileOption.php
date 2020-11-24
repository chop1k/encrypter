<?php

namespace Encrypter\Option;

use Consolly\Option\Option;
use Encrypter\Exception\FileUnattainableException;

class FileOption extends Option
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
     */
    public function isRequiresValue(): bool
    {
        return true;
    }

    private string $value;

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function setValue(string $value): void
    {
        if (!is_file($value))
        {
            throw new FileUnattainableException("value of option '--file' isn't a path to file or file not found");
        }

        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function isRequired(): bool
    {
        return false;
    }

    private bool $indicated;

    /**
     * @return bool
     */
    public function isIndicated(): bool
    {
        return $this->indicated;
    }

    /**
     * @inheritDoc
     */
    public function setIndicated(bool $value): void
    {
        $this->indicated = $value;
    }

    public function __construct()
    {
        $this->indicated = false;
        $this->value = false;
    }
}
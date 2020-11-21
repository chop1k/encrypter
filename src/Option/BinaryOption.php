<?php

namespace Encrypter\Option;

use Consolly\Option\Option;

class BinaryOption extends Option
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
     * @inheritDoc
     */
    public function isRequiresValue(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function setValue(string $value): void
    {

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
    }
}
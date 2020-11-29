<?php

namespace Encrypter\Option;

use Consolly\Option\Option;

class IVOption extends Option
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
     * @inheritDoc
     */
    public function isRequiresValue(): bool
    {
        return true;
    }

    protected string $value;

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
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function isRequired(): bool
    {
        return false;
    }

    protected bool $indicated;

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
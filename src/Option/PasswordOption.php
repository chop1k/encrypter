<?php

namespace Encrypter\Option;

use Consolly\Option\Option;

class PasswordOption extends Option
{

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return "password";
    }

    /**
     * @inheritDoc
     */
    public function getAbbreviation(): ?string
    {
        return "p";
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
        $this->value = $value;

        var_dump("password value: $value");
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
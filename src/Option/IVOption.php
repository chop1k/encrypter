<?php

namespace Encrypter\Option;

class IVOption extends \Consolly\Option\Option
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
        $this->value = hash('md5', $value, true);
    }

    /**
     * @inheritDoc
     */
    public function isRequired(): bool
    {
        return true;
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
}
<?php


namespace Encrypter\Option;


use Consolly\Option\Option;

class AlgorithmOption extends Option
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
    }

    protected bool $required;

    /**
     * @inheritDoc
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     */
    public function setRequired(bool $required): void
    {
        $this->required = $required;
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
        $this->required = false;
        $this->indicated = false;
        $this->value = false;
    }
}
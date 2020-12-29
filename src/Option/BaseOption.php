<?php

namespace Encrypter\Option;

use Consolly\Option\Option;

/**
 * Class BaseOption represents class with general functionality.
 *
 * @package Encrypter\Option
 */
class BaseOption extends Option
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getAbbreviation(): ?string
    {
        return false;
    }

    /**
     * Contains requiresValue bool value.
     *
     * @var bool $requiresValue
     */
    protected bool $requiresValue;

    /**
     * @inheritDoc
     */
    public function isRequiresValue(): bool
    {
        return $this->requiresValue;
    }

    /**
     * Sets requiresValue bool value.
     *
     * @param bool $requiresValue
     */
    public function setRequiresValue(bool $requiresValue): void
    {
        $this->requiresValue = $requiresValue;
    }

    /**
     * Contains option value;
     *
     * @var string $value
     */
    protected string $value;

    /**
     * Returns option value.
     *
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
     * Contains required bool value.
     *
     * @var bool $required
     */
    protected bool $required;

    /**
     * @inheritDoc
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * Sets required bool value.
     *
     * @param bool $required
     */
    public function setRequired(bool $required): void
    {
        $this->required = $required;
    }

    /**
     * Contains indicated bool value.
     *
     * @var bool $indicated
     */
    protected bool $indicated;

    /**
     * Returns indicated bool value.
     *
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
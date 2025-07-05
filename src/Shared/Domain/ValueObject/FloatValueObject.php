<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObject;

abstract class FloatValueObject
{
    protected $value;

    public function __construct(?float $value)
    {
        $this->value = $value;
    }

    public function value(): ?float
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value();
    }
}

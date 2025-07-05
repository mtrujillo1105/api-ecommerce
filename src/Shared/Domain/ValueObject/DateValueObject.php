<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObject;

use Carbon\Carbon;

abstract class DateValueObject
{
    protected $value;

    public function __construct(?string $value)
    {
        $this->value = (!is_null($value)) ? Carbon::parse($value) : null;
    }

    public function value(): ?string
    {
        // return $this->value;
        // return $this->value->format('Y-m-d H:i:s');
        return (!is_null($this->value)) ? $this->value->format('Y-m-d') : null;
    }

    public function __toString()
    {
        // return $this->value();
        return (!is_null($this->value)) ? $this->value->format('Y-m-d') : '';
    }
}

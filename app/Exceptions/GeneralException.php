<?php

namespace App\Exceptions;

use Exception;

class GeneralException extends Exception
{

    public static function InternalException(): static
    {
        return new static(message: "internal server error", code: 500);
    }
}

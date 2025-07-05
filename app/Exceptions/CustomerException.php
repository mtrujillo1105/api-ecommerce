<?php

namespace App\Exceptions;


class CustomerException extends GeneralException
{

    public static function errorCli(): CustomerException
    {
        return new self(message: "error cliente personal", code: 400);
    }
}

<?php

declare(strict_types=1);

namespace Src\Administrator\PersonType\Domain;

use Src\Administrator\PersonType\Domain\ValueObjects\PersonTypeDescripcion;

final class PersonType
{
    private $descripcion;

    public function __construct(
        PersonTypeDescripcion $descripcion
    ) {
        $this->descripcion = $descripcion;
    }

    public function descripcion(): PersonTypeDescripcion
    {
        return $this->descripcion;
    }

    public static function create(
        PersonTypeDescripcion $descripcion,
    ): PersonType {
        $persType = new self(
            $descripcion
        );

        return $persType;
    }
}

<?php

declare(strict_types=1);

namespace Src\Administrator\CivilStatus\Domain;

use Src\Administrator\CivilStatus\Domain\ValueObjects\CivilStatusDescripcion;
use Src\Administrator\CivilStatus\Domain\ValueObjects\CivilStatusStatus;

final class CivilStatus
{
    private $descripcion;
    private $estado;

    public function __construct(
        CivilStatusDescripcion $descripcion,
        CivilStatusStatus $estado
    ) {
        $this->descripcion = $descripcion;
        $this->estado = $estado;
    }

    public function descripcion(): CivilStatusDescripcion
    {
        return $this->descripcion;
    }

    public function estado(): CivilStatusStatus
    {
        return $this->estado;
    }

    public static function create(
        CivilStatusDescripcion $descripcion,
        CivilStatusStatus $estado,
    ): CivilStatus {
        $persType = new self(
            $descripcion,
            $estado,
        );

        return $persType;
    }
}

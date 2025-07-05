<?php

declare(strict_types=1);

namespace Src\Administrator\Nationality\Domain;

use Src\Administrator\Nationality\Domain\ValueObjects\NationalityCodigo;
use Src\Administrator\Nationality\Domain\ValueObjects\NationalityPais;
use Src\Administrator\Nationality\Domain\ValueObjects\NationalityGentilicio;

final class Nationality
{
    private $codigo;
    private $pais;
    private $gentilicio;

    public function __construct(
        NationalityCodigo $codigo,
        NationalityPais $pais,
        NationalityGentilicio $gentilicio,
    ) {
        $this->codigo = $codigo;
        $this->pais = $pais;
        $this->gentilicio = $gentilicio;
    }

    public function codigo(): NationalityCodigo
    {
        return $this->codigo;
    }
    public function pais(): NationalityPais
    {
        return $this->pais;
    }
    public function gentilicio(): NationalityGentilicio
    {
        return $this->gentilicio;
    }

    public static function create(
        NationalityCodigo $codigo,
        NationalityPais $pais,
        NationalityGentilicio $gentilicio,
    ): Nationality {
        $nat = new self(
            $codigo,
            $pais,
            $gentilicio
        );

        return $nat;
    }
}

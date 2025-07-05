<?php

declare(strict_types=1);

namespace Src\Administrator\Ubigeo\Domain;

use Src\Administrator\Ubigeo\Domain\ValueObjects\UbigeoUbigeo;
use Src\Administrator\Ubigeo\Domain\ValueObjects\UbigeoDepartamento;
use Src\Administrator\Ubigeo\Domain\ValueObjects\UbigeoProvincia;
use Src\Administrator\Ubigeo\Domain\ValueObjects\UbigeoDistrito;

final class Ubigeo
{
    private $ubigeo;
    private $departamento;
    private $provincia;
    private $distrito;

    public function __construct(
        UbigeoUbigeo $ubigeo,
        UbigeoDepartamento $departamento,
        UbigeoProvincia $provincia,
        UbigeoDistrito $distrito,

    ) {
        $this->ubigeo = $ubigeo;
        $this->departamento = $departamento;
        $this->provincia = $provincia;
        $this->distrito = $distrito;
    }

    public function ubigeo(): UbigeoUbigeo
    {
        return $this->ubigeo;
    }
    public function departamento(): UbigeoDepartamento
    {
        return $this->departamento;
    }
    public function provincia(): UbigeoProvincia
    {
        return $this->provincia;
    }
    public function distrito(): UbigeoDistrito
    {
        return $this->distrito;
    }

    public static function create(
        UbigeoUbigeo $ubigeo,
        UbigeoDepartamento $departamento,
        UbigeoProvincia $provincia,
        UbigeoDistrito $distrito,
    ): Ubigeo {
        $ubi = new self(
            $ubigeo,
            $departamento,
            $provincia,
            $distrito,
        );

        return $ubi;
    }
}

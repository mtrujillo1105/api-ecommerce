<?php

declare(strict_types=1);

namespace Src\Administrator\PersonDetail\Domain;

use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailPersonaId;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailDepartamentoId;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailProvinciaId;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailDistritoId;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailNacionalidadId;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailDireccion;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailEmail;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailTelefono;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailFoto;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailPeso;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailEstatura;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailDiscapacitado;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailConsumeAlcohol;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailConsumeDrogas;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailGrupoSanguineo;

final class PersonDetail
{

    private $personaId;
    private $departamentoId;
    private $provinciaId;
    private $distritoId;
    private $nacionalidadId;
    private $direccion;
    private $email;
    private $telefono;
    private $foto;
    private $peso;
    private $estatura;
    private $discapacitado;
    private $consumeAlcohol;
    private $consumeDrogas;
    private $grupoSanguineo;


    public function __construct(
        PersonDetailPersonaId $personaId,
        PersonDetailDepartamentoId $departamentoId,
        PersonDetailProvinciaId $provinciaId,
        PersonDetailDistritoId $distritoId,
        PersonDetailNacionalidadId $nacionalidadId,
        PersonDetailDireccion $direccion,
        PersonDetailEmail $email,
        PersonDetailTelefono $telefono,
        PersonDetailFoto $foto,
        PersonDetailPeso $peso,
        PersonDetailEstatura $estatura,
        PersonDetailDiscapacitado $discapacitado,
        PersonDetailConsumeAlcohol $consumeAlcohol,
        PersonDetailConsumeDrogas $consumeDrogas,
        PersonDetailGrupoSanguineo $grupoSanguineo,
    ) {
        $this->personaId = $personaId;
        $this->departamentoId = $departamentoId;
        $this->provinciaId = $provinciaId;
        $this->distritoId = $distritoId;
        $this->nacionalidadId = $nacionalidadId;
        $this->direccion = $direccion;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->foto = $foto;
        $this->peso = $peso;
        $this->estatura = $estatura;
        $this->discapacitado = $discapacitado;
        $this->consumeAlcohol = $consumeAlcohol;
        $this->consumeDrogas = $consumeDrogas;
        $this->grupoSanguineo = $grupoSanguineo;
    }

    public function personaId(): PersonDetailPersonaId
    {
        return $this->personaId;
    }
    public function departamentoId(): PersonDetailDepartamentoId
    {
        return $this->departamentoId;
    }
    public function provinciaId(): PersonDetailProvinciaId
    {
        return $this->provinciaId;
    }
    public function distritoId(): PersonDetailDistritoId
    {
        return $this->distritoId;
    }
    public function nacionalidadId(): PersonDetailNacionalidadId
    {
        return $this->nacionalidadId;
    }
    public function direccion(): PersonDetailDireccion
    {
        return $this->direccion;
    }
    public function email(): PersonDetailEmail
    {
        return $this->email;
    }
    public function telefono(): PersonDetailTelefono
    {
        return $this->telefono;
    }
    public function foto(): PersonDetailFoto
    {
        return $this->foto;
    }
    public function peso(): PersonDetailPeso
    {
        return $this->peso;
    }
    public function estatura(): PersonDetailEstatura
    {
        return $this->estatura;
    }
    public function discapacitado(): PersonDetailDiscapacitado
    {
        return $this->discapacitado;
    }
    public function consumeAlcohol(): PersonDetailConsumeAlcohol
    {
        return $this->consumeAlcohol;
    }
    public function consumeDrogas(): PersonDetailConsumeDrogas
    {
        return $this->consumeDrogas;
    }
    public function grupoSanguineo(): PersonDetailGrupoSanguineo
    {
        return $this->grupoSanguineo;
    }

    public static function create(
        PersonDetailPersonaId $personaId,
        PersonDetailDepartamentoId $departamentoId,
        PersonDetailProvinciaId $provinciaId,
        PersonDetailDistritoId $distritoId,
        PersonDetailNacionalidadId $nacionalidadId,
        PersonDetailDireccion $direccion,
        PersonDetailEmail $email,
        PersonDetailTelefono $telefono,
        PersonDetailFoto $foto,
        PersonDetailPeso $peso,
        PersonDetailEstatura $estatura,
        PersonDetailDiscapacitado $discapacitado,
        PersonDetailConsumeAlcohol $consumeAlcohol,
        PersonDetailConsumeDrogas $consumeDrogas,
        PersonDetailGrupoSanguineo $grupoSanguineo,

    ): PersonDetail {
        $perDet = new self(
            $personaId,
            $departamentoId,
            $provinciaId,
            $distritoId,
            $nacionalidadId,
            $direccion,
            $email,
            $telefono,
            $foto,
            $peso,
            $estatura,
            $discapacitado,
            $consumeAlcohol,
            $consumeDrogas,
            $grupoSanguineo,
        );

        return $perDet;
    }
}

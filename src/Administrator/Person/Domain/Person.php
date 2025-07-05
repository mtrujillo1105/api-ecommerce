<?php

declare(strict_types=1);

namespace Src\Administrator\Person\Domain;

use Src\Administrator\Person\Domain\ValueObjects\PersonApeMaterno;
use Src\Administrator\Person\Domain\ValueObjects\PersonApePaterno;
use Src\Administrator\Person\Domain\ValueObjects\PersonEstadoCivilId;
use Src\Administrator\Person\Domain\ValueObjects\PersonFechaNacimiento;
use Src\Administrator\Person\Domain\ValueObjects\PersonNombre;
use Src\Administrator\Person\Domain\ValueObjects\PersonNroDocumento;
use Src\Administrator\Person\Domain\ValueObjects\PersonRazonSocial;
use Src\Administrator\Person\Domain\ValueObjects\PersonSexo;
use Src\Administrator\Person\Domain\ValueObjects\PersonTipoDocumentoId;
use Src\Administrator\Person\Domain\ValueObjects\PersonTipoPersonaId;

final class Person
{
    private $apePaterno;
    private $apeMaterno;
    private $nombre;
    private $razonSocial;
    private $tipoPersonaId;
    private $tipoDocumentoId;
    private $estadoCivilId;
    private $nroDocumento;
    private $fechaNacimiento;
    private $sexo;


    public function __construct(
        PersonApePaterno $apePaterno,
        PersonApeMaterno $apeMaterno,
        PersonNombre $nombre,
        PersonRazonSocial $razonSocial,
        PersonTipoPersonaId $tipoPersonaId,
        PersonTipoDocumentoId $tipoDocumentoId,
        PersonEstadoCivilId $estadoCivilId,
        PersonNroDocumento $nroDocumento,
        PersonFechaNacimiento $fechaNacimiento,
        PersonSexo $sexo
    ) {
        $this->apePaterno = $apePaterno;
        $this->apeMaterno = $apeMaterno;
        $this->nombre = $nombre;
        $this->razonSocial = $razonSocial;
        $this->tipoPersonaId = $tipoPersonaId;
        $this->tipoDocumentoId = $tipoDocumentoId;
        $this->estadoCivilId = $estadoCivilId;
        $this->nroDocumento = $nroDocumento;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->sexo = $sexo;
    }

    public function apePaterno(): PersonApePaterno
    {
        return $this->apePaterno;
    }
    public function apeMaterno(): PersonApeMaterno
    {
        return $this->apeMaterno;
    }
    public function nombre(): PersonNombre
    {
        return $this->nombre;
    }
    public function razonSocial(): PersonRazonSocial
    {
        return $this->razonSocial;
    }
    public function tipoPersonaId(): PersonTipoPersonaId
    {
        return $this->tipoPersonaId;
    }
    public function tipoDocumentoId(): PersonTipoDocumentoId
    {
        return $this->tipoDocumentoId;
    }
    public function estadoCivilId(): PersonEstadoCivilId
    {
        return $this->estadoCivilId;
    }
    public function nroDocumento(): PersonNroDocumento
    {
        return $this->nroDocumento;
    }
    public function fechaNacimiento(): PersonFechaNacimiento
    {
        return $this->fechaNacimiento;
    }
    public function sexo(): PersonSexo
    {
        return $this->sexo;
    }

    /** Proceso create Eloquent*/
    public static function create(
        PersonApePaterno $apePaterno,
        PersonApeMaterno $apeMaterno,
        PersonNombre $nombre,
        PersonRazonSocial $razonSocial,
        PersonTipoPersonaId $tipoPersonaId,
        PersonTipoDocumentoId $tipoDocumentoId,
        PersonEstadoCivilId $estadoCivilId,
        PersonNroDocumento $nroDocumento,
        PersonFechaNacimiento $fechaNacimiento,
        PersonSexo $sexo,
    ): Person {
        $person = new self(
            $apePaterno,
            $apeMaterno,
            $nombre,
            $razonSocial,
            $tipoPersonaId,
            $tipoDocumentoId,
            $estadoCivilId,
            $nroDocumento,
            $fechaNacimiento,
            $sexo,
        );

        return $person;
    }
}

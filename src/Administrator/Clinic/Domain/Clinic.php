<?php

declare(strict_types=1);

namespace Src\Administrator\Clinic\Domain;

use Src\Administrator\Clinic\Domain\ValueObjects\ClinicUsuarioId;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicCodigo;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicRedMedicaId;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicUbigeoId;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicNombre;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicRuc;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicTelefono;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicEmail;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicDireccion;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicTipo;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicAcceso;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicEntVinculada;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicIpress;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicRenipress;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicEstado;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicZona;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicIgv;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicSede;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicUbicacion;

final class Clinic
{
    private $usuarioId;
    private $codigo;
    private $redMedicaId;
    private $ubigeoId;
    private $nombre;
    private $ruc;
    private $telefono;
    private $email;
    private $direccion;
    private $tipo;
    private $acceso;
    private $entVinculada;
    private $ipress;
    private $renipress;
    private $estado;
    private $zona;
    private $igv;
    private $sede;
    private $ubicacion;

    public function __construct(
        ClinicUsuarioId $usuarioId,
        ClinicCodigo $codigo,
        ClinicRedMedicaId $redMedicaId,
        ClinicUbigeoId $ubigeoId,
        ClinicNombre $nombre,
        ClinicRuc $ruc,
        ClinicTelefono $telefono,
        ClinicEmail $email,
        ClinicDireccion $direccion,
        ClinicTipo $tipo,
        ClinicAcceso $acceso,
        ClinicEntVinculada $entVinculada,
        ClinicIpress $ipress,
        ClinicRenipress $renipress,
        ClinicEstado $estado,
        ClinicZona $zona,
        ClinicIgv $igv,
        ClinicSede $sede,
        ClinicUbicacion $ubicacion,
    ) {
        $this->usuarioId = $usuarioId;
        $this->codigo = $codigo;
        $this->redMedicaId = $redMedicaId;
        $this->ubigeoId = $ubigeoId;
        $this->nombre = $nombre;
        $this->ruc = $ruc;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->direccion = $direccion;
        $this->tipo = $tipo;
        $this->acceso = $acceso;
        $this->entVinculada = $entVinculada;
        $this->ipress = $ipress;
        $this->renipress = $renipress;
        $this->estado = $estado;
        $this->zona = $zona;
        $this->igv = $igv;
        $this->sede = $sede;
        $this->ubicacion = $ubicacion;
    }

    public function usuarioId(): ClinicUsuarioId
    {
        return $this->usuarioId;
    }
    public function codigo(): ClinicCodigo
    {
        return $this->codigo;
    }
    public function redMedicaId(): ClinicRedMedicaId
    {
        return $this->redMedicaId;
    }
    public function ubigeoId(): ClinicUbigeoId
    {
        return $this->ubigeoId;
    }
    public function nombre(): ClinicNombre
    {
        return $this->nombre;
    }
    public function ruc(): ClinicRuc
    {
        return $this->ruc;
    }
    public function telefono(): ClinicTelefono
    {
        return $this->telefono;
    }
    public function email(): ClinicEmail
    {
        return $this->email;
    }
    public function direccion(): ClinicDireccion
    {
        return $this->direccion;
    }
    public function tipo(): ClinicTipo
    {
        return $this->tipo;
    }
    public function acceso(): ClinicAcceso
    {
        return $this->acceso;
    }
    public function entVinculada(): ClinicEntVinculada
    {
        return $this->entVinculada;
    }
    public function ipress(): ClinicIpress
    {
        return $this->ipress;
    }
    public function renipress(): ClinicRenipress
    {
        return $this->renipress;
    }
    public function estado(): ClinicEstado
    {
        return $this->estado;
    }
    public function zona(): ClinicZona
    {
        return $this->zona;
    }
    public function igv(): ClinicIgv
    {
        return $this->igv;
    }
    public function sede(): ClinicSede
    {
        return $this->sede;
    }
    public function ubicacion(): ClinicUbicacion
    {
        return $this->ubicacion;
    }

    public static function create(
        ClinicUsuarioId $usuarioId,
        ClinicCodigo $codigo,
        ClinicRedMedicaId $redMedicaId,
        ClinicUbigeoId $ubigeoId,
        ClinicNombre $nombre,
        ClinicRuc $ruc,
        ClinicTelefono $telefono,
        ClinicEmail $email,
        ClinicDireccion $direccion,
        ClinicTipo $tipo,
        ClinicAcceso $acceso,
        ClinicEntVinculada $entVinculada,
        ClinicIpress $ipress,
        ClinicRenipress $renipress,
        ClinicEstado $estado,
        ClinicZona $zona,
        ClinicIgv $igv,
        ClinicSede $sede,
        ClinicUbicacion $ubicacion,
    ): Clinic {
        $clinic = new self(
            $usuarioId,
            $codigo,
            $redMedicaId,
            $ubigeoId,
            $nombre,
            $ruc,
            $telefono,
            $email,
            $direccion,
            $tipo,
            $acceso,
            $entVinculada,
            $ipress,
            $renipress,
            $estado,
            $zona,
            $igv,
            $sede,
            $ubicacion,
        );

        return $clinic;
    }
}

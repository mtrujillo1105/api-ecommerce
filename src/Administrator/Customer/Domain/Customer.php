<?php

declare(strict_types=1);

namespace Src\Administrator\Customer\Domain;

use Src\Administrator\Customer\Domain\ValueObjects\CustomerCodIafa;
use Src\Administrator\Customer\Domain\ValueObjects\CustomerCodigo;
use Src\Administrator\Customer\Domain\ValueObjects\CustomerEstado;
use Src\Administrator\Customer\Domain\ValueObjects\CustomerIdEquivSis;
use Src\Administrator\Customer\Domain\ValueObjects\CustomerNombre;
use Src\Administrator\Customer\Domain\ValueObjects\CustomerNombreCorto;
use Src\Administrator\Customer\Domain\ValueObjects\CustomerRuc;

final class Customer
{
    private $codigo;
    private $nombre;
    private $nombreCorto;
    private $ruc;
    private $codIafa;
    private $estado;
    private $idEquivSis;

    public function __construct(
        CustomerCodigo $codigo,
        CustomerNombre $nombre,
        CustomerNombreCorto $nombreCorto,
        CustomerRuc $ruc,
        CustomerCodIafa $codIafa,
        CustomerEstado $estado,
        CustomerIdEquivSis $idEquivSis
    ) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->nombreCorto = $nombreCorto;
        $this->ruc = $ruc;
        $this->codIafa = $codIafa;
        $this->estado = $estado;
        $this->idEquivSis = $idEquivSis;
    }

    public function codigo(): CustomerCodigo
    {
        return $this->codigo;
    }
    public function nombre(): CustomerNombre
    {
        return $this->nombre;
    }
    public function nombreCorto(): CustomerNombreCorto
    {
        return $this->nombreCorto;
    }
    public function ruc(): CustomerRuc
    {
        return $this->ruc;
    }
    public function codIafa(): CustomerCodIafa
    {
        return $this->codIafa;
    }
    public function estado(): CustomerEstado
    {
        return $this->estado;
    }
    public function idEquivSis(): CustomerIdEquivSis
    {
        return $this->idEquivSis;
    }

    /** Proceso create Eloquent*/
    public static function create(
        CustomerCodigo $codigo,
        CustomerNombre $nombre,
        CustomerNombreCorto $nombreCorto,
        CustomerRuc $ruc,
        CustomerCodIafa $codIafa,
        CustomerEstado $estado,
        CustomerIdEquivSis $idEquivSis

    ): Customer {
        $customer = new self(
            $codigo,
            $nombre,
            $nombreCorto,
            $ruc,
            $codIafa,
            $estado,
            $idEquivSis,
        );

        return $customer;
    }
}

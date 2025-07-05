<?php

declare(strict_types=1);

namespace Src\Administrator\Affiliate\Domain;

use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliatePersonaId;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateClienteId;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateCategoriaId;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliatePlanId;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateMotivoBajaId;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateAfiliadoTitularId;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateCodTitula;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateCentrocosto;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateFechaAlta;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateFechaBaja;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateFechaFinCarencia;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateFechaContinuidad;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateFinancia;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateContrato;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateCodAfiliado;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateEstado;


final class Affiliate
{
    private $personaId;
    private $clienteId;
    private $categoriaId;
    private $planId;
    private $motivoBajaId;
    private $afiliadoTitularId;
    private $codTitula;
    private $centroCosto;
    private $fechaAlta;
    private $fechaBaja;
    private $fechaFinCarencia;
    private $fechaContinuidad;
    private $financia;
    private $contrato;
    private $codAfiliado;
    private $estado;


    public function __construct(
        AffiliatePersonaId $personaId,
        AffiliateClienteId $clienteId,
        AffiliateCategoriaId $categoriaId,
        AffiliatePlanId $planId,
        AffiliateMotivoBajaId $motivoBajaId,
        AffiliateAfiliadoTitularId $afiliadoTitularId,
        AffiliateCodTitula $codTitula,
        AffiliateCentrocosto $centroCosto,
        AffiliateFechaAlta $fechaAlta,
        AffiliateFechaBaja $fechaBaja,
        AffiliateFechaFinCarencia $fechaFinCarencia,
        AffiliateFechaContinuidad $fechaContinuidad,
        AffiliateFinancia $financia,
        AffiliateContrato $contrato,
        AffiliateCodAfiliado $codAfiliado,
        AffiliateEstado $estado,
    ) {

        $this->personaId = $personaId;
        $this->clienteId = $clienteId;
        $this->categoriaId = $categoriaId;
        $this->planId = $planId;
        $this->motivoBajaId = $motivoBajaId;
        $this->afiliadoTitularId = $afiliadoTitularId;
        $this->codTitula = $codTitula;
        $this->centroCosto = $centroCosto;
        $this->fechaAlta = $fechaAlta;
        $this->fechaBaja = $fechaBaja;
        $this->fechaFinCarencia = $fechaFinCarencia;
        $this->fechaContinuidad = $fechaContinuidad;
        $this->financia = $financia;
        $this->contrato = $contrato;
        $this->codAfiliado = $codAfiliado;
        $this->estado = $estado;
    }

    public function personaId(): AffiliatePersonaId
    {
        return $this->personaId;
    }
    public function clienteId(): AffiliateClienteId
    {
        return $this->clienteId;
    }
    public function categoriaId(): AffiliateCategoriaId
    {
        return $this->categoriaId;
    }
    public function planId(): AffiliatePlanId
    {
        return $this->planId;
    }
    public function motivoBajaId(): AffiliateMotivoBajaId
    {
        return $this->motivoBajaId;
    }
    public function afiliadoTitularId(): AffiliateAfiliadoTitularId
    {
        return $this->afiliadoTitularId;
    }
    public function codTitula(): AffiliateCodTitula
    {
        return $this->codTitula;
    }
    public function centroCosto(): AffiliateCentrocosto
    {
        return $this->centroCosto;
    }
    public function fechaAlta(): AffiliateFechaAlta
    {
        return $this->fechaAlta;
    }
    public function fechaBaja(): AffiliateFechaBaja
    {
        return $this->fechaBaja;
    }
    public function fechaFinCarencia(): AffiliateFechaFinCarencia
    {
        return $this->fechaFinCarencia;
    }
    public function fechaContinuidad(): AffiliateFechaContinuidad
    {
        return $this->fechaContinuidad;
    }
    public function financia(): AffiliateFinancia
    {
        return $this->financia;
    }
    public function contrato(): AffiliateContrato
    {
        return $this->contrato;
    }
    public function codAfiliado(): AffiliateCodAfiliado
    {
        return $this->codAfiliado;
    }
    public function estado(): AffiliateEstado
    {
        return $this->estado;
    }


    /** Proceso create Eloquent*/
    public static function create(
        AffiliatePersonaId $personaId,
        AffiliateClienteId $clienteId,
        AffiliateCategoriaId $categoriaId,
        AffiliatePlanId $planId,
        AffiliateMotivoBajaId $motivoBajaId,
        AffiliateAfiliadoTitularId $afiliadoTitularId,
        AffiliateCodTitula $codTitula,
        AffiliateCentrocosto $centroCosto,
        AffiliateFechaAlta $fechaAlta,
        AffiliateFechaBaja $fechaBaja,
        AffiliateFechaFinCarencia $fechaFinCarencia,
        AffiliateFechaContinuidad $fechaContinuidad,
        AffiliateFinancia $financia,
        AffiliateContrato $contrato,
        AffiliateCodAfiliado $codAfiliado,
        AffiliateEstado $estado,
    ): Affiliate {
        $affiliate = new self(
            $personaId,
            $clienteId,
            $categoriaId,
            $planId,
            $motivoBajaId,
            $afiliadoTitularId,
            $codTitula,
            $centroCosto,
            $fechaAlta,
            $fechaBaja,
            $fechaFinCarencia,
            $fechaContinuidad,
            $financia,
            $contrato,
            $codAfiliado,
            $estado,
        );

        return $affiliate;
    }
}

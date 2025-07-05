<?php

namespace Src\Administrator\Plandbf\Domain;

use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfAplicaLimiteCobertura;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfClienteId;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfClinicaId;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfCoaseguro;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfCoberturaId;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfDeducible;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfEdadMaxima;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfEstado;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfFechaFin;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfFechaInicio;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfFormaPago;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfidEquivSis;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfLimiteCobertura;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfObs;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfParentesco;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfPlanId;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfTipoDeducible;

final class Plandbf
{
    private $clienteId;
    private $clinicaId;
    private $planId;
    private $coberturaId;
    private $tipoded;
    private $formapago;
    private $deducible;
    private $coaseguro;
    private $limitecob;
    private $observa;
    private $parentesco;
    private $fini;
    private $ffin;
    private $edadMaxima;
    private $aplicaLimitecob;
    private $estado;


    /**
     * @return PlandbfClienteId
     */
    public function getClienteId(): PlandbfClienteId
    {
        return $this->clienteId;
    }

    /**
     * @return PlandbfClinicaId
     */
    public function getClinicaId(): PlandbfClinicaId
    {
        return $this->clinicaId;
    }

    /**
     * @return PlandbfPlanId
     */
    public function getPlanId(): PlandbfPlanId
    {
        return $this->planId;
    }

    /**
     * @return PlandbfCoberturaId
     */
    public function getCoberturaId(): PlandbfCoberturaId
    {
        return $this->coberturaId;
    }

    /**
     * @return PlandbfTipoDeducible
     */
    public function getTipoded(): PlandbfTipoDeducible
    {
        return $this->tipoded;
    }

    /**
     * @return PlandbfFormaPago
     */
    public function getFormapago(): PlandbfFormaPago
    {
        return $this->formapago;
    }

    /**
     * @return PlandbfDeducible
     */
    public function getDeducible(): PlandbfDeducible
    {
        return $this->deducible;
    }

    /**
     * @return PlandbfCoaseguro
     */
    public function getCoaseguro(): PlandbfCoaseguro
    {
        return $this->coaseguro;
    }

    /**
     * @return PlandbfLimiteCobertura
     */
    public function getLimitecob(): PlandbfLimiteCobertura
    {
        return $this->limitecob;
    }

    /**
     * @return PlandbfObs
     */
    public function getObserva(): PlandbfObs
    {
        return $this->observa;
    }

    /**
     * @return PlandbfParentesco
     */
    public function getParentesco(): PlandbfParentesco
    {
        return $this->parentesco;
    }

    /**
     * @return PlandbfFechaInicio
     */
    public function getFini(): PlandbfFechaInicio
    {
        return $this->fini;
    }

    /**
     * @return PlandbfFechaFin
     */
    public function getFfin(): PlandbfFechaFin
    {
        return $this->ffin;
    }

    /**
     * @return PlandbfEdadMaxima
     */
    public function getEdadMaxima(): PlandbfEdadMaxima
    {
        return $this->edadMaxima;
    }

    /**
     * @return PlandbfAplicaLimiteCobertura
     */
    public function getAplicaLimitecob(): PlandbfAplicaLimiteCobertura
    {
        return $this->aplicaLimitecob;
    }

    /**
     * @return PlandbfEstado
     */
    public function getEstado(): PlandbfEstado
    {
        return $this->estado;
    }    /**
     * @return PlandbfEstado
     */
   

    /**
     * @param $clienteId
     * @param $clinicaId
     * @param $planId
     * @param $coberturaId
     * @param $tipoded
     * @param $formapago
     * @param $deducible
     * @param $coaseguro
     * @param $limitecob
     * @param $observa
     * @param $parentesco
     * @param $fini
     * @param $ffin
     * @param $edadMaxima
     * @param $aplicaLimitecob
     * @param $estado
     * @param $idEquivSis
     */
    public function __construct(
        PlandbfClienteId $clienteId,
        PlandbfClinicaId $clinicaId,
        PlandbfPlanId $planId,
        PlandbfCoberturaId $coberturaId,
        PlandbfTipoDeducible $tipoded,
        PlandbfFormaPago $formapago,
        PlandbfDeducible $deducible,
        PlandbfCoaseguro $coaseguro,
        PlandbfLimiteCobertura $limitecob,
        PlandbfObs $observa,
        PlandbfParentesco $parentesco,
        PlandbfFechaInicio $fini,
        PlandbfFechaFin $ffin,
        PlandbfEdadMaxima $edadMaxima,
        PlandbfAplicaLimiteCobertura $aplicaLimitecob,
        PlandbfEstado $estado
    ) {
        $this->clienteId = $clienteId;
        $this->clinicaId = $clinicaId;
        $this->planId = $planId;
        $this->coberturaId = $coberturaId;
        $this->tipoded = $tipoded;
        $this->formapago = $formapago;
        $this->deducible = $deducible;
        $this->coaseguro = $coaseguro;
        $this->limitecob = $limitecob;
        $this->observa = $observa;
        $this->parentesco = $parentesco;
        $this->fini = $fini;
        $this->ffin = $ffin;
        $this->edadMaxima = $edadMaxima;
        $this->aplicaLimitecob = $aplicaLimitecob;
        $this->estado = $estado;
    }

    public static function create(
        PlandbfClienteId $clienteId,
        PlandbfClinicaId $clinicaId,
        PlandbfPlanId $planId,
        PlandbfCoberturaId $coberturaId,
        PlandbfTipoDeducible $tipoded,
        PlandbfFormaPago $formapago,
        PlandbfDeducible $deducible,
        PlandbfCoaseguro $coaseguro,
        PlandbfLimiteCobertura $limitecob,
        PlandbfObs $observa,
        PlandbfParentesco $parentesco,
        PlandbfFechaInicio $fini,
        PlandbfFechaFin $ffin,
        PlandbfEdadMaxima $edadMaxima,
        PlandbfAplicaLimiteCobertura $aplicaLimitecob,
        PlandbfEstado $estado
    ): Plandbf {
        return new self(
            $clienteId,
            $clinicaId,
            $planId,
            $coberturaId,
            $tipoded,
            $formapago,
            $deducible,
            $coaseguro,
            $limitecob,
            $observa,
            $parentesco,
            $fini,
            $ffin,
            $edadMaxima,
            $aplicaLimitecob,
            $estado
        );
    }


}

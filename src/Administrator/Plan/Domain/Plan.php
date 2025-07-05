<?php

declare(strict_types=1);

namespace Src\Administrator\Plan\Domain;

use Src\Administrator\Plan\Domain\ValueObjects\PlanClienteId;
use Src\Administrator\Plan\Domain\ValueObjects\PlanCodigo;
use Src\Administrator\Plan\Domain\ValueObjects\PlanIdEquivSis;
use Src\Administrator\Plan\Domain\ValueObjects\PlanNombre;

use Src\Administrator\Plan\Domain\ValueObjects\PlanTipoBeneficio;
use Src\Administrator\Plan\Domain\ValueObjects\PlanBeneficioMaximo;
use Src\Administrator\Plan\Domain\ValueObjects\PlanComentarioBenefMax;

use Src\Administrator\Plan\Domain\ValueObjects\PlanEstado;
use Src\Administrator\Plan\Domain\ValueObjects\PlanCodigoPlanSs;
use Src\Administrator\Plan\Domain\ValueObjects\PlanDescripcionPlanSs;

use Src\Administrator\Plan\Domain\ValueObjects\PlanCodigoProductoSs;
use Src\Administrator\Plan\Domain\ValueObjects\PlanDescripcionProductoSs;
use Src\Administrator\Plan\Domain\ValueObjects\PlanTipoPlanSs;

final class Plan
{

    private $clienteId;
    private $codigo;
    private $nombre;
    private $tipoBeneficio;
    private $beneficioMaximo;
    private $comentarioBenefMax;
    private $estado;
    private $codigoPlanSs;
    private $descripcionPlanSs;
    private $codigoProductoSs;
    private $descripcionProductoSs;
    private $tipoPlanSs;
    private $idEquivSis;

    public function __construct(
        PlanClienteId $clienteId,
        PlanCodigo $codigo,
        PlanNombre $nombre,
        PlanTipoBeneficio $tipoBeneficio,
        PlanBeneficioMaximo $beneficioMaximo,
        PlanComentarioBenefMax $comentarioBenefMax,
        PlanEstado $estado,
        PlanCodigoPlanSs $codigoPlanSs,
        PlanDescripcionPlanSs $descripcionPlanSs,
        PlanCodigoProductoSs $codigoProductoSs,
        PlanDescripcionProductoSs $descripcionProductoSs,
        PlanTipoPlanSs $tipoPlanSs,
        PlanIdEquivSis $idEquivSis
    ) {
        $this->clienteId = $clienteId;
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->tipoBeneficio = $tipoBeneficio;
        $this->beneficioMaximo = $beneficioMaximo;
        $this->comentarioBenefMax = $comentarioBenefMax;
        $this->estado = $estado;
        $this->codigoPlanSs = $codigoPlanSs;
        $this->descripcionPlanSs = $descripcionPlanSs;
        $this->codigoProductoSs = $codigoProductoSs;
        $this->descripcionProductoSs = $descripcionProductoSs;
        $this->tipoPlanSs = $tipoPlanSs;
        $this->idEquivSis = $idEquivSis;
    }

    public function clienteId(): PlanClienteId
    {
        return $this->clienteId;
    }
    public function codigo(): PlanCodigo
    {
        return $this->codigo;
    }
    public function nombre(): PlanNombre
    {
        return $this->nombre;
    }
    public function tipoBeneficio(): PlanTipoBeneficio
    {
        return $this->tipoBeneficio;
    }
    public function beneficioMaximo(): PlanBeneficioMaximo
    {
        return $this->beneficioMaximo;
    }
    public function comentarioBenefMax(): PlanComentarioBenefMax
    {
        return $this->comentarioBenefMax;
    }
    public function estado(): PlanEstado
    {
        return $this->estado;
    }
    public function codigoPlanSs(): PlanCodigoPlanSs
    {
        return $this->codigoPlanSs;
    }
    public function descripcionPlanSs(): PlanDescripcionPlanSs
    {
        return $this->descripcionPlanSs;
    }
    public function codigoProductoSs(): PlanCodigoProductoSs
    {
        return $this->codigoProductoSs;
    }
    public function descripcionProductoSs(): PlanDescripcionProductoSs
    {
        return $this->descripcionProductoSs;
    }
    public function tipoPlanSs(): PlanTipoPlanSs
    {
        return $this->tipoPlanSs;
    }

    public function idEquivSis(): PlanIdEquivSis
    {
        return $this->idEquivSis;
    }

    public static function create(
        PlanClienteId $clienteId,
        PlanCodigo $codigo,
        PlanNombre $nombre,
        PlanTipoBeneficio $tipoBeneficio,
        PlanBeneficioMaximo $beneficioMaximo,
        PlanComentarioBenefMax $comentarioBenefMax,
        PlanEstado $estado,
        PlanCodigoPlanSs $codigoPlanSs,
        PlanDescripcionPlanSs $descripcionPlanSs,
        PlanCodigoProductoSs $codigoProductoSs,
        PlanDescripcionProductoSs $descripcionProductoSs,
        PlanTipoPlanSs $tipoPlanSs,
        PlanIdEquivSis $idEquivSis
    ): Plan {
        return new self(
            $clienteId,
            $codigo,
            $nombre,
            $tipoBeneficio,
            $beneficioMaximo,
            $comentarioBenefMax,
            $estado,
            $codigoPlanSs,
            $descripcionPlanSs,
            $codigoProductoSs,
            $descripcionProductoSs,
            $tipoPlanSs,
            $idEquivSis,
        );
    }
}

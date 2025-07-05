<?php

namespace Src\Administrator\Plan\Application\Update;

use Src\Administrator\Plan\Domain\Contracts\PlanRepositoryContract;
use Src\Administrator\Plan\Domain\Plan;
use Src\Administrator\Plan\Domain\ValueObjects\PlanBeneficioMaximo;
use Src\Administrator\Plan\Domain\ValueObjects\PlanClienteId;
use Src\Administrator\Plan\Domain\ValueObjects\PlanCodigo;
use Src\Administrator\Plan\Domain\ValueObjects\PlanCodigoPlanSs;
use Src\Administrator\Plan\Domain\ValueObjects\PlanCodigoProductoSs;
use Src\Administrator\Plan\Domain\ValueObjects\PlanComentarioBenefMax;
use Src\Administrator\Plan\Domain\ValueObjects\PlanDescripcionPlanSs;
use Src\Administrator\Plan\Domain\ValueObjects\PlanDescripcionProductoSs;
use Src\Administrator\Plan\Domain\ValueObjects\PlanEstado;
use Src\Administrator\Plan\Domain\ValueObjects\PlanIdEquivSis;
use Src\Administrator\Plan\Domain\ValueObjects\PlanNombre;
use Src\Administrator\Plan\Domain\ValueObjects\PlanTipoBeneficio;
use Src\Administrator\Plan\Domain\ValueObjects\PlanTipoPlanSs;
use Src\Administrator\Shared\Domain\Plan\PlanId;

final class PlanUpdater
{
    private $repository;

    public function __construct(PlanRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $idEquivSis,
        ?int $clienteId,
        string $codigo,
        ?string $nombre,
        ?bool $estado,
        ?string $tipoBeneficio,
        ?float $beneficioMaximo,
        ?string $comentarioBenefMax,
        ?string $codigoPlanSs,
        ?string $descripcionPlanSs,
        ?string $codigoProductoSs,
        ?string $descripcionProductoSs,
        ?int $tipoPlanSs
    ): PlanId {

        $clienteId = new PlanClienteId($clienteId);
        $codigo = new PlanCodigo($codigo);
        $nombre = new PlanNombre($nombre);
        $tipoBeneficio = new PlanTipoBeneficio($tipoBeneficio);
        $beneficioMaximo = new PlanBeneficioMaximo($beneficioMaximo);
        $comentarioBenefMax = new PlanComentarioBenefMax($comentarioBenefMax);
        $estado = new PlanEstado($estado);
        $codigoPlanSs = new PlanCodigoPlanSs($codigoPlanSs);
        $descripcionPlanSs = new PlanDescripcionPlanSs($descripcionPlanSs);
        $codigoProductoSs = new PlanCodigoProductoSs($codigoProductoSs);
        $descripcionProductoSs = new PlanDescripcionProductoSs($descripcionProductoSs);
        $tipoPlanSs = new PlanTipoPlanSs($tipoPlanSs);
        $idEquivSis = new PlanIdEquivSis($idEquivSis);

        $person = Plan::create(
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

        $id = $this->repository->update($idEquivSis, $person);
        return new PlanId($id);
    }

}

<?php

namespace Src\Administrator\Plandbf\Application\Create;

use Src\Administrator\Plandbf\Domain\Contracts\PlandbfRepositoryContract;
use Src\Administrator\Plandbf\Domain\Plandbf;
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
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfIdSis;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfLimiteCobertura;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfObs;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfParentesco;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfPlanId;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfTipoDeducible;
use Src\Administrator\Shared\Domain\Plandbf\PlandbfId;

final class PlandbfCreator
{
    private $repository;

    public function __construct(PlandbfRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $clienteId,
        int $clinicaId,
        int $planId,
        int  $coberturaId,
        ?string $tipoded,
        ?string $formapago,
        ?float $deducible,
        ?string $coaseguro,
        ?string $limitecob,
        ?string $observa,
        ?string $parentesco,
        ?string $fini,
        ?string $ffin,
        ?int $edadMaxima,
        ?bool $aplicaLimitecob,
        ?bool $estado
    ): PlandbfId{
        $person = Plandbf::create(
            new PlandbfClienteId($clienteId),
            new PlandbfClinicaId($clinicaId),
            new PlandbfPlanId($planId),
            new PlandbfCoberturaId($coberturaId),
            new PlandbfTipoDeducible($tipoded),
            new PlandbfFormaPago($formapago),
            new PlandbfDeducible($deducible),
            new PlandbfCoaseguro($coaseguro),
            new PlandbfLimiteCobertura($limitecob),
            new PlandbfObs($observa),
            new PlandbfParentesco($parentesco),
            new PlandbfFechaInicio($fini),
            new PlandbfFechaFin($ffin),
            new PlandbfEdadMaxima($edadMaxima),
            new PlandbfAplicaLimiteCobertura($aplicaLimitecob),
            new PlandbfEstado($estado)
        );

        $id = $this->repository->save($person);
        $id = new PlandbfId($id);
        return $id;
    }
}

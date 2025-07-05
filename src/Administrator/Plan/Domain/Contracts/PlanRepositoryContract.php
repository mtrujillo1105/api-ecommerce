<?php

declare(strict_types=1);

namespace Src\Administrator\Plan\Domain\Contracts;

use Src\Administrator\Plan\Domain\Plan;
use Src\Administrator\Plan\Domain\ValueObjects\PlanCodigo;
use Src\Administrator\Plan\Domain\ValueObjects\PlanIdEquivSis;
use Src\Administrator\Shared\Domain\Plan\PlanId;

interface PlanRepositoryContract
{
    public function findPlan(PlanId $id): ?Plan;
    public function findPlanByCode(PlanCodigo $code): ?int;
    public function findPlanByIdEquivSis(PlanIdEquivSis $idEquivSis, $idClient);
    public function findCoverage($codigoCoverage);    
    public function save(Plan $plan): ?int;
    public function update(PlanIdEquivSis $id, Plan $plan): ?int;
    public function  findPlanIafa( $idEquivSisPlan, $idClient );

    
}

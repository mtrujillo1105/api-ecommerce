<?php

declare(strict_types=1);

namespace Src\Administrator\Plan\Application\Get;

use Src\Administrator\Plan\Domain\Contracts\PlanRepositoryContract;
use Src\Administrator\Plan\Domain\Plan;
use Src\Administrator\Plan\Domain\ValueObjects\PlanCodigo;
use Src\Administrator\Shared\Domain\Plan\PlanId;

final class GetPlanByCode
{
    private $repository;

    public function __construct(PlanRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $code): ?int
    {
        $code = new PlanCodigo($code);
        return $this->repository->findPlanByCode($code);
    }
}

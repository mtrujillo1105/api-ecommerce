<?php

declare(strict_types=1);

namespace Src\Administrator\Plan\Application\Get;

use Src\Administrator\Plan\Domain\Contracts\PlanRepositoryContract;
use Src\Administrator\Plan\Domain\Plan;
use Src\Administrator\Shared\Domain\Plan\PlanId;

final class GetPlan
{
    private $repository;

    public function __construct(PlanRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?Plan
    {
        $id = new PlanId($id);
        $plan = $this->repository->findPlan($id);
        return $plan;
    }
}

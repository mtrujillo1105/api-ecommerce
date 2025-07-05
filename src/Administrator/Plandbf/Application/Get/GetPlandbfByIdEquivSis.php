<?php

namespace Src\Administrator\Plandbf\Application\Get;

use Src\Administrator\Plandbf\Domain\Contracts\PlandbfRepositoryContract;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfIdEquivSis;

final class GetPlandbfByIdEquivSis
{
    private $repository;

    public function __construct(PlandbfRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $idEquivSis): ?int {
        $idEquivSis = new PlandbfIdEquivSis($idEquivSis);
        return $this->repository->findByIdEquivSis($idEquivSis);
    }
}

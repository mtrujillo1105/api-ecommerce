<?php

namespace Src\Administrator\Plandbf\Domain\Contracts;

use Src\Administrator\Plandbf\Domain\Plandbf;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfIdEquivSis;

interface PlandbfRepositoryContract
{
    public function save(Plandbf $plan): ?int;
    public function update(Plandbf $plan): ?int;
    public function findByIdEquivSis(PlandbfIdEquivSis $idEquivSis): ?int;

}

<?php

declare(strict_types=1);

namespace Src\Administrator\Coverage\Domain\Contracts;

use Src\Administrator\Coverage\Domain\Coverage;

interface CoverageRepositoryContract
{
    public function save(Coverage $plan): ?int;
    public function update(int $id, Coverage $plan): ?int;
    public function findByCode(string $icode): ?Coverage;
}

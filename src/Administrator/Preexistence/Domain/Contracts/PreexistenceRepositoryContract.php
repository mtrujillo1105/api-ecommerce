<?php

namespace Src\Administrator\Preexistence\Domain\Contracts;

use Src\Administrator\Preexistence\Domain\Preexistence;

interface PreexistenceRepositoryContract
{
    public function save(Preexistence $plan): ?int;
}

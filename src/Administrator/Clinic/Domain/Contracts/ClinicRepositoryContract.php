<?php

declare(strict_types=1);

namespace Src\Administrator\Clinic\Domain\Contracts;

use Src\Administrator\Clinic\Domain\Clinic;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicCodigo;

interface ClinicRepositoryContract
{
    public function save(Clinic $plan): ?int;
    public function findByCode(ClinicCodigo $code): ?Clinic;
}

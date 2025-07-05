<?php

namespace Src\Administrator\Clinic\Application\Get;

use Src\Administrator\Clinic\Domain\Clinic;
use Src\Administrator\Clinic\Domain\Contracts\ClinicRepositoryContract;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicCodigo;

final class GetClinicByCode
{
    private $repository;

    public function __construct(ClinicRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $code): ?Clinic {
        $code = new ClinicCodigo($code);
        return $this->repository->findByCode($code);
    }
}

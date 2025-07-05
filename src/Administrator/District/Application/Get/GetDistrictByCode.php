<?php

namespace Src\Administrator\District\Application\Get;

use Src\Administrator\District\Domain\Contracts\DistrictRepositoryContract;
use Src\Administrator\District\Domain\ValueObjects\DistrictCode;

final class GetDistrictByCode
{
    private $repository;

    public function __construct(DistrictRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $code): ?int
    {
        $code = new DistrictCode($code);
        $distric = $this->repository->findDistrictByCode($code);
        return $distric;
    }
}

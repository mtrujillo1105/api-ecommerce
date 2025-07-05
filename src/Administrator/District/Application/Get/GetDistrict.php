<?php

declare(strict_types=1);

namespace Src\Administrator\District\Application\Get;

use Src\Administrator\District\Domain\Contracts\DistrictRepositoryContract;
use Src\Administrator\District\Domain\District;
use Src\Administrator\Shared\Domain\District\DistrictId;

final class GetDistrict
{
    private $repository;

    public function __construct(DistrictRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?District
    {
        $id = new DistrictId($id);
        $distric = $this->repository->findDistrict($id);
        return $distric;
    }
}

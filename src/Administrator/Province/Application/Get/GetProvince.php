<?php

declare(strict_types=1);

namespace Src\Administrator\Province\Application\Get;

use Src\Administrator\Province\Domain\Contracts\ProvinceRepositoryContract;
use Src\Administrator\Province\Domain\Province;
use Src\Administrator\Shared\Domain\Province\ProvinceId;

final class GetProvince
{
    private $repository;

    public function __construct(ProvinceRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?Province
    {
        $id = new ProvinceId($id);
        $prov = $this->repository->findProvince($id);
        return $prov;
    }
}

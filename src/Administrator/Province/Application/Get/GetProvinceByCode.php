<?php

declare(strict_types=1);

namespace Src\Administrator\Province\Application\Get;

use Src\Administrator\Province\Domain\Contracts\ProvinceRepositoryContract;
use Src\Administrator\Province\Domain\Province;
use Src\Administrator\Province\Domain\ValueObjects\ProvinceCodigo;
use Src\Administrator\Shared\Domain\Province\ProvinceId;

final class GetProvinceByCode
{
    private $repository;

    public function __construct(ProvinceRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $code): ?int
    {
        $code = new ProvinceCodigo($code);
        return $this->repository->findProvinceByCode($code);
    }
}

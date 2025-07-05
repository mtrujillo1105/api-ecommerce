<?php

declare(strict_types=1);

namespace Src\Administrator\Province\Domain\Contracts;

use Src\Administrator\Province\Domain\Province;
use Src\Administrator\Province\Domain\ValueObjects\ProvinceCodigo;
use Src\Administrator\Shared\Domain\Province\ProvinceId;

interface ProvinceRepositoryContract
{
    public function findProvince(ProvinceId $id): ?Province;
    public function findProvinceByCode(ProvinceCodigo $id): ?int;
    public function save(Province $provincia): void;
}

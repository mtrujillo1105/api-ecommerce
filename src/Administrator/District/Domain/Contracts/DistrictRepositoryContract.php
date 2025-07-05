<?php

declare(strict_types=1);

namespace Src\Administrator\District\Domain\Contracts;

use Src\Administrator\District\Domain\District;
use Src\Administrator\District\Domain\ValueObjects\DistrictCode;
use Src\Administrator\Shared\Domain\District\DistrictId;

interface DistrictRepositoryContract
{
    public function findDistrict(DistrictId $id): ?District;
    public function findDistrictByCode(DistrictCode $code): ?int;
    public function save(District $distrito): void;
}

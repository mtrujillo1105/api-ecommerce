<?php

declare(strict_types=1);

namespace Src\Administrator\Nationality\Domain\Contracts;

use Src\Administrator\Nationality\Domain\Nationality;
use Src\Administrator\Shared\Domain\Nationality\NationalityId;

interface NationalityRepositoryContract
{
    public function findNationality(NationalityId $id): ?Nationality;
    public function save(Nationality $nacionalidad): void;
}

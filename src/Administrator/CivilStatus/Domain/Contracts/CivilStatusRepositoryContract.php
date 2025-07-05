<?php

declare(strict_types=1);

namespace Src\Administrator\CivilStatus\Domain\Contracts;

use Src\Administrator\CivilStatus\Domain\CivilStatus;
use Src\Administrator\Shared\Domain\CivilStatus\CivilStatusId;

interface CivilStatusRepositoryContract
{
    public function findCivilStatus(CivilStatusId $id): ?CivilStatus;
    public function save(CivilStatus $civilStatus): void;
}

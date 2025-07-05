<?php

declare(strict_types=1);

namespace Src\Administrator\PersonDetail\Domain\Contracts;

use Src\Administrator\PersonDetail\Domain\PersonDetail;
use Src\Administrator\Shared\Domain\PersonDetail\PersonDetailId;

interface PersonDetailRepositoryContract
{
    // public function findPersonDetail(PersonDetailId $id): ?PersonDetail;
    public function save(PersonDetail $personDetail): ?int;
}

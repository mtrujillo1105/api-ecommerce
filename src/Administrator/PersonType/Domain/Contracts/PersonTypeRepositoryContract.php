<?php

declare(strict_types=1);

namespace Src\Administrator\PersonType\Domain\Contracts;

use Src\Administrator\PersonType\Domain\PersonType;
use Src\Administrator\Shared\Domain\PersonType\PersonTypeId;

interface PersonTypeRepositoryContract
{
    public function findPersonType(PersonTypeId $id): ?PersonType;
    public function save(PersonType $tipopersona): void;
}

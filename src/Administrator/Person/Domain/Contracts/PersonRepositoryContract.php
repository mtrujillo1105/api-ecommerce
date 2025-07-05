<?php

declare(strict_types=1);

namespace Src\Administrator\Person\Domain\Contracts;

use Src\Administrator\Person\Domain\Person;

interface PersonRepositoryContract
{
    public function save(Person $persona): ?int;
    // public function save(Person $customer): void;
}

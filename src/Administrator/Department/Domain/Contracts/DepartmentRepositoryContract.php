<?php

declare(strict_types=1);

namespace Src\Administrator\Department\Domain\Contracts;

use Src\Administrator\Department\Domain\Department;
use Src\Administrator\Department\Domain\ValueObjects\DepartamentCode;
use Src\Administrator\Shared\Domain\Department\DepartmentId;

interface DepartmentRepositoryContract
{
    public function findDepartment(DepartmentId $id): ?Department;
    public function findDepartmentByCode(DepartamentCode $code): ?int;
    public function save(Department $departamento): void;
}

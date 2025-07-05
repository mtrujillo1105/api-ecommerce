<?php

declare(strict_types=1);

namespace Src\Administrator\Department\Application\Get;

use Src\Administrator\Department\Domain\Contracts\DepartmentRepositoryContract;
use Src\Administrator\Department\Domain\Department;
use Src\Administrator\Shared\Domain\Department\DepartmentId;

final class GetDepartment
{
    private $repository;

    public function __construct(DepartmentRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?Department
    {
        $id = new DepartmentId($id);
        $civS = $this->repository->findDepartment($id);
        return $civS;
    }
}

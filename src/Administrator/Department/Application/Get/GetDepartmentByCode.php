<?php

declare(strict_types=1);

namespace Src\Administrator\Department\Application\Get;

use Src\Administrator\Department\Domain\Contracts\DepartmentRepositoryContract;
use Src\Administrator\Department\Domain\Department;
use Src\Administrator\Department\Domain\ValueObjects\DepartamentCode;
use Src\Administrator\Shared\Domain\Department\DepartmentId;

final class GetDepartmentByCode
{
    private $repository;

    public function __construct(DepartmentRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $code): ?int
    {
        $code = new DepartamentCode($code);
        $civS = $this->repository->findDepartmentByCode($code);
        return $civS;
    }
}

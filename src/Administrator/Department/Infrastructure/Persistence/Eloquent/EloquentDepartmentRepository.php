<?php

declare(strict_types=1);

namespace Src\Administrator\Department\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Department as EloquentDepartmentModel;
use Src\Administrator\Department\Domain\Contracts\DepartmentRepositoryContract;
use Src\Administrator\Department\Domain\ValueObjects\DepartamentCode;
use Src\Administrator\Shared\Domain\Department\DepartmentId;
use Src\Administrator\Department\Domain\Department;
use Src\Administrator\Department\Domain\ValueObjects\DepartmentNombre;

final class EloquentDepartmentRepository implements DepartmentRepositoryContract
{
    private $eloquentDepartmentModel;

    public function __construct()
    {
        $this->eloquentDepartmentModel = new EloquentDepartmentModel;
    }

    public function findDepartment(DepartmentId $id): ?Department
    {
        try {
            $docType = $this->eloquentDepartmentModel->findOrFail($id->value());
            return new Department(
                new DepartmentNombre($docType->name)
            );
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function save(Department $docType): void
    {
    }

    public function findDepartmentByCode(DepartamentCode $code): ?int
    {
        try {
            $docType = $this->eloquentDepartmentModel->where('codigo', $code->value())->firstOrFail();
            return $docType->id;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}

<?php

declare(strict_types=1);

namespace Src\Administrator\CivilStatus\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\CivilStatus as EloquentCivilStatusModel;
use Src\Administrator\CivilStatus\Domain\Contracts\CivilStatusRepositoryContract;
use Src\Administrator\Shared\Domain\CivilStatus\CivilStatusId;
use Src\Administrator\CivilStatus\Domain\CivilStatus;
use Src\Administrator\CivilStatus\Domain\ValueObjects\CivilStatusDescripcion;
use Src\Administrator\CivilStatus\Domain\ValueObjects\CivilStatusStatus;

final class EloquentCivilStatusRepository implements CivilStatusRepositoryContract
{
    private $eloquentCivilStatusModel;

    public function __construct()
    {
        $this->eloquentCivilStatusModel = new EloquentCivilStatusModel;
    }

    public function findCivilStatus(CivilStatusId $id): ?CivilStatus
    {
        try {
            $docType = $this->eloquentCivilStatusModel->findOrFail($id->value());
            return new CivilStatus(
                new CivilStatusDescripcion($docType->descripcion),
                new CivilStatusStatus($docType->stado),
            );
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function save(CivilStatus $docType): void
    {
    }
}

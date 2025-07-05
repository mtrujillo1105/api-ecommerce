<?php

declare(strict_types=1);

namespace Src\Administrator\PersonType\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\PersonType as EloquentPersonTypeModel;
use Src\Administrator\PersonType\Domain\Contracts\PersonTypeRepositoryContract;
use Src\Administrator\PersonType\Domain\PersonType;
use Src\Administrator\Shared\Domain\PersonType\PersonTypeId;
use Src\Administrator\PersonType\Domain\ValueObjects\PersonTypeDescripcion;

final class EloquentPersonTypeRepository implements PersonTypeRepositoryContract
{
    private $eloquentPersonTypeModel;

    public function __construct()
    {
        $this->eloquentPersonTypeModel = new EloquentPersonTypeModel;
    }

    public function findPersonType(PersonTypeId $id): ?PersonType
    {
        try {
            $docType = $this->eloquentPersonTypeModel->findOrFail($id->value());
            return new PersonType(
                new PersonTypeDescripcion($docType->descripcion)
            );
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function save(PersonType $docType): void
    {
    }
}

<?php

declare(strict_types=1);

namespace Src\Administrator\DocumentType\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\DocumentType as EloquentDocumentTypeModel;
use Src\Administrator\DocumentType\Domain\Contracts\DocumentTypeRepositoryContract;
use Src\Administrator\DocumentType\Domain\DocumentType;
use Src\Administrator\Shared\Domain\DocumentType\DocumentTypeId;
use Src\Administrator\DocumentType\Domain\ValueObjects\DocumentTypeDescripcion;
use Src\Administrator\DocumentType\Domain\ValueObjects\DocumentTypeEstado;
use Src\Administrator\DocumentType\Domain\ValueObjects\DocumentTypeSiglas;

final class EloquentDocumentTypeRepository implements DocumentTypeRepositoryContract
{
    private $eloquentDocumentTypeModel;

    public function __construct()
    {
        $this->eloquentDocumentTypeModel = new eloquentDocumentTypeModel;
    }

    public function findDocumentType(DocumentTypeId $id): ?DocumentType
    {
        try {
            $docType = $this->eloquentDocumentTypeModel->findOrFail($id->value());
            return new DocumentType(
                new DocumentTypeDescripcion($docType->descripcion),
                new DocumentTypeSiglas($docType->siglas),
                new DocumentTypeEstado($docType->estado)
            );
        } catch (ModelNotFoundException $me) {
            return null;
        }
    }

    public function save(DocumentType $docType): void
    {
    }
}

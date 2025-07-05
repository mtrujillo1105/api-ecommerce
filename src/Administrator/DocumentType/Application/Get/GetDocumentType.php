<?php

declare(strict_types=1);

namespace Src\Administrator\DocumentType\Application\Get;

use Src\Administrator\DocumentType\Domain\Contracts\DocumentTypeRepositoryContract;
use Src\Administrator\DocumentType\Domain\DocumentType;
use Src\Administrator\Shared\Domain\DocumentType\DocumentTypeId;

final class GetDocumentType
{
    private $repository;

    public function __construct(DocumentTypeRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?DocumentType
    {
        $id = new DocumentTypeId($id);
        $docType = $this->repository->findDocumentType($id);
        return $docType;
    }
}

<?php

declare(strict_types=1);

namespace Src\Administrator\DocumentType\Domain\Contracts;

use Src\Administrator\DocumentType\Domain\DocumentType;
use Src\Administrator\Shared\Domain\DocumentType\DocumentTypeId;

interface DocumentTypeRepositoryContract
{
    public function findDocumentType(DocumentTypeId $id): ?DocumentType;
    public function save(DocumentType $docType): void;
}

<?php

declare(strict_types=1);

namespace Src\Administrator\Category\Domain\Contracts;

use Src\Administrator\Category\Domain\Category;
use Src\Administrator\Category\Domain\ValueObjects\CategoryCodigo;
use Src\Administrator\Shared\Domain\Category\CategoryId;

interface CategoryRepositoryContract
{
    public function findCategory(CategoryId $id): ?Category;
    public function findCategoryByCode(CategoryCodigo $code): ?int;
    public function save(Category $categoria): void;
}

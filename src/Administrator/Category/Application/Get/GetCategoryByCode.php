<?php

declare(strict_types=1);

namespace Src\Administrator\Category\Application\Get;

use Src\Administrator\Category\Domain\Contracts\CategoryRepositoryContract;
use Src\Administrator\Category\Domain\Category;
use Src\Administrator\Category\Domain\ValueObjects\CategoryCodigo;
use Src\Administrator\Shared\Domain\Category\CategoryId;

final class GetCategoryByCode
{
    private $repository;

    public function __construct(CategoryRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id): ?int
    {
        $id = new CategoryCodigo($id);
        return $this->repository->findCategoryByCode($id);
    }
}

<?php

declare(strict_types=1);

namespace Src\Administrator\Category\Application\Get;

use Src\Administrator\Category\Domain\Contracts\CategoryRepositoryContract;
use Src\Administrator\Category\Domain\Category;
use Src\Administrator\Shared\Domain\Category\CategoryId;

final class GetCategory
{
    private $repository;

    public function __construct(CategoryRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?Category
    {
        $id = new CategoryId($id);
        $catg = $this->repository->findCategory($id);
        return $catg;
    }
}

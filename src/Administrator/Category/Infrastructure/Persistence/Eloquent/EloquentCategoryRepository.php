<?php

declare(strict_types=1);

namespace Src\Administrator\Category\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Category as EloquentCategoryModel;
use Src\Administrator\Category\Domain\Contracts\CategoryRepositoryContract;
use Src\Administrator\Shared\Domain\Category\CategoryId;
use Src\Administrator\Category\Domain\Category;

use Src\Administrator\Category\Domain\ValueObjects\CategoryCodigo;
use Src\Administrator\Category\Domain\ValueObjects\CategoryDescripcion;
use Src\Administrator\Category\Domain\ValueObjects\CategoryParentescoSusaludId;


final class EloquentCategoryRepository implements CategoryRepositoryContract
{
    private $eloquentCategoryModel;

    public function __construct()
    {
        $this->eloquentCategoryModel = new EloquentCategoryModel;
    }

    public function findCategory(CategoryId $id): ?Category
    {
        try {
            $catg = $this->eloquentCategoryModel->findOrFail($id->value());
            return new Category(
                new CategoryCodigo($catg->codigo),
                new CategoryDescripcion($catg->descripcion),
                new CategoryParentescoSusaludId($catg->parentescoSusaludId)
            );
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function save(Category $distc): void
    {
    }

    public function findCategoryByCode(CategoryCodigo $code): ?int
    {
        try {
            $catg = $this->eloquentCategoryModel->where('codigo', $code->value())->firstOrFail();
            return $catg->id;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}

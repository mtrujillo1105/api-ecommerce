<?php

declare(strict_types=1);

namespace Src\Administrator\Category\Domain;

use Src\Administrator\Category\Domain\ValueObjects\CategoryCodigo;
use Src\Administrator\Category\Domain\ValueObjects\CategoryDescripcion;
use Src\Administrator\Category\Domain\ValueObjects\CategoryParentescoSusaludId;

final class Category
{
    private $codigo;
    private $descripcion;
    private $parentescoSusaludId;

    public function __construct(
        CategoryCodigo $codigo,
        CategoryDescripcion $descripcion,
        CategoryParentescoSusaludId $parentescoSusaludId,
    ) {
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->parentescoSusaludId = $parentescoSusaludId;
    }

    public function codigo(): CategoryCodigo
    {
        return $this->codigo;
    }
    public function descripcion(): CategoryDescripcion
    {
        return $this->descripcion;
    }
    public function parentescoSusaludId(): CategoryParentescoSusaludId
    {
        return $this->parentescoSusaludId;
    }
    public static function create(
        CategoryCodigo $codigo,
        CategoryDescripcion $descripcion,
        CategoryParentescoSusaludId $parentescoSusaludId,
    ): Category {
        $cat = new self(
            $codigo,
            $descripcion,
            $parentescoSusaludId,
        );

        return $cat;
    }
}

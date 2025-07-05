<?php

declare(strict_types=1);

namespace Src\Administrator\DocumentType\Domain;

use Src\Administrator\DocumentType\Domain\ValueObjects\DocumentTypeDescripcion;
use Src\Administrator\DocumentType\Domain\ValueObjects\DocumentTypeEstado;
use Src\Administrator\DocumentType\Domain\ValueObjects\DocumentTypeSiglas;

final class DocumentType
{
    private $descripcion;
    private $siglas;
    private $estado;

    public function __construct(
        DocumentTypeDescripcion $descripcion,
        DocumentTypeSiglas $siglas,
        DocumentTypeEstado $estado,
    ) {
        $this->descripcion = $descripcion;
        $this->siglas = $siglas;
        $this->estado = $estado;
    }

    public function descripcion(): DocumentTypeDescripcion
    {
        return $this->descripcion;
    }
    public function siglas(): DocumentTypeSiglas
    {
        return $this->siglas;
    }
    public function estado(): DocumentTypeEstado
    {
        return $this->estado;
    }

    public static function create(
        DocumentTypeDescripcion $descripcion,
        DocumentTypeSiglas $siglas,
        DocumentTypeEstado $estado,
    ): DocumentType {
        $DocumentType = new self(
            $descripcion,
            $siglas,
            $estado
        );

        return $DocumentType;
    }
}

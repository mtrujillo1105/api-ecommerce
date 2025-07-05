<?php

declare(strict_types=1);

namespace Src\Administrator\Department\Domain;

use Src\Administrator\Department\Domain\ValueObjects\DepartmentNombre;

final class Department
{
    private $nombre;

    public function __construct(
        DepartmentNombre $nombre,
    ) {
        $this->nombre = $nombre;
    }

    public function nombre(): DepartmentNombre
    {
        return $this->nombre;
    }

    public static function create(
        DepartmentNombre $nombre,
    ): Department {
        $dept = new self(
            $nombre,
        );

        return $dept;
    }
}

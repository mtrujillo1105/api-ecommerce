<?php

declare(strict_types=1);

namespace Src\Administrator\District\Domain;

use Src\Administrator\District\Domain\ValueObjects\DistrictNombre;
use Src\Administrator\District\Domain\ValueObjects\DistrictProvinciaId;

final class District
{
    private $nombre;
    private $provinciaId;

    public function __construct(
        DistrictNombre $nombre,
        DistrictProvinciaId $provinciaId,
    ) {
        $this->nombre = $nombre;
        $this->provinciaId = $provinciaId;
    }

    public function nombre(): DistrictNombre
    {
        return $this->nombre;
    }
    public function provinciaId(): DistrictProvinciaId
    {
        return $this->provinciaId;
    }

    public static function create(
        DistrictNombre $nombre,
        DistrictProvinciaId $provinciaId,
    ): District {
        $distr = new self(
            $nombre,
            $provinciaId,
        );

        return $distr;
    }
}

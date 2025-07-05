<?php

declare(strict_types=1);

namespace Src\Administrator\Province\Domain;

use Src\Administrator\Province\Domain\ValueObjects\ProvinceNombre;
use Src\Administrator\Province\Domain\ValueObjects\ProvinceDepartamentoId;

final class Province
{
    private $nombre;
    private $departamentoId;

    public function __construct(
        ProvinceNombre $nombre,
        ProvinceDepartamentoId $departamentoId,
    ) {
        $this->nombre = $nombre;
        $this->departamentoId = $departamentoId;
    }

    public function nombre(): ProvinceNombre
    {
        return $this->nombre;
    }
    public function departamentoId(): ProvinceDepartamentoId
    {
        return $this->departamentoId;
    }

    public static function create(
        ProvinceNombre $nombre,
        ProvinceDepartamentoId $departamentoId,
    ): Province {
        $province = new self(
            $nombre,
            $departamentoId,
        );

        return $province;
    }
}

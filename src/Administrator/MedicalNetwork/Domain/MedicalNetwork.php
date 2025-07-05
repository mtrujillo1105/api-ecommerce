<?php

declare(strict_types=1);

namespace Src\Administrator\MedicalNetwork\Domain;

use Src\Administrator\MedicalNetwork\Domain\ValueObjects\MedicalNetworkNombre;

final class MedicalNetwork
{
    private $nombre;

    public function __construct(
        MedicalNetworkNombre $nombre,
    ) {
        $this->nombre = $nombre;
    }

    public function nombre(): MedicalNetworkNombre
    {
        return $this->nombre;
    }

    public static function create(
        MedicalNetworkNombre $nombre,
    ): MedicalNetwork {
        $medNet = new self(
            $nombre,
        );

        return $medNet;
    }
}

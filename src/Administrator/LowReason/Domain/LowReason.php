<?php

declare(strict_types=1);

namespace Src\Administrator\LowReason\Domain;

use Src\Administrator\LowReason\Domain\ValueObjects\LowReasonEstado;
use Src\Administrator\LowReason\Domain\ValueObjects\LowReasonDescripcion;

final class LowReason
{
    private $descripcion;
    private $estado;

    public function __construct(
        LowReasonDescripcion $descripcion,
        LowReasonEstado $estado,
    ) {
        $this->descripcion = $descripcion;
        $this->estado = $estado;
    }

    public function descripcion(): LowReasonDescripcion
    {
        return $this->descripcion;
    }
    public function estado(): LowReasonEstado
    {
        return $this->estado;
    }

    public static function create(
        LowReasonDescripcion $descripcion,
        LowReasonEstado $estado,
    ): LowReason {
        $lowR = new self(
            $descripcion,
            $estado
        );

        return $lowR;
    }
}

<?php

namespace Src\Administrator\Notification\Domain;

use Src\Administrator\Notification\Domain\ValueObjects\NotificationAvisoSisId;
use Src\Administrator\Notification\Domain\ValueObjects\NotificationClientId;
use Src\Administrator\Notification\Domain\ValueObjects\NotificationDescripcion;
use Src\Administrator\Notification\Domain\ValueObjects\NotificationEstado;
use Src\Administrator\Notification\Domain\ValueObjects\NotificationFechaVencimiento;
use Src\Administrator\Notification\Domain\ValueObjects\NotificationTipo;

final class Notification
{
    private $clientId;
    private $description;
    private $tipo;
    private $estado;
    private $fechaVencimiento;
    private $avisoSisId;

    /**
     * @param NotificationClientId $clientId
     * @param NotificationDescripcion $description
     * @param NotificationTipo $tipo
     * @param NotificationEstado $estado
     * @param NotificationFechaVencimiento $fechaVencimiento
     * @param NotificationAvisoSisId $avisoSisId
     */
    public function __construct(
        NotificationClientId $clientId,
        NotificationDescripcion $description,
        NotificationTipo $tipo,
        NotificationEstado $estado,
        NotificationFechaVencimiento $fechaVencimiento,
        NotificationAvisoSisId $avisoSisId
    ) {
        $this->clientId = $clientId;
        $this->description = $description;
        $this->tipo = $tipo;
        $this->estado = $estado;
        $this->fechaVencimiento = $fechaVencimiento;
        $this->avisoSisId = $avisoSisId;
    }

    /**
     * @return NotificationClientId
     */
    public function getClientId(): NotificationClientId
    {
        return $this->clientId;
    }

    /**
     * @return NotificationDescripcion
     */
    public function getDescription(): NotificationDescripcion
    {
        return $this->description;
    }

    /**
     * @return NotificationTipo
     */
    public function getTipo(): NotificationTipo
    {
        return $this->tipo;
    }

    /**
     * @return NotificationEstado
     */
    public function getEstado(): NotificationEstado
    {
        return $this->estado;
    }

    /**
     * @return NotificationFechaVencimiento
     */
    public function getFechaVencimiento(): NotificationFechaVencimiento
    {
        return $this->fechaVencimiento;
    }

    /**
     * @return NotificationAvisoSisId
     */
    public function getAvisoSisId(): NotificationAvisoSisId
    {
        return $this->avisoSisId;
    }

    public static function create(
        NotificationClientId $clientId,
        NotificationDescripcion $description,
        NotificationTipo $tipo,
        NotificationEstado $estado,
        NotificationFechaVencimiento $fechaVencimiento,
        NotificationAvisoSisId $avisoSisId
    ): Notification {
        return new self(
            $clientId,
            $description,
            $tipo,
            $estado,
            $fechaVencimiento,
            $avisoSisId
        );
    }
}

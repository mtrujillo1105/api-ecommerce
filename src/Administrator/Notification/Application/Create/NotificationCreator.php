<?php

namespace Src\Administrator\Notification\Application\Create;

use Src\Administrator\Notification\Domain\Contracts\NotificationRepositoryContract;
use Src\Administrator\Notification\Domain\Notification;
use Src\Administrator\Notification\Domain\ValueObjects\NotificationAvisoSisId;
use Src\Administrator\Notification\Domain\ValueObjects\NotificationClientId;
use Src\Administrator\Notification\Domain\ValueObjects\NotificationDescripcion;
use Src\Administrator\Notification\Domain\ValueObjects\NotificationEstado;
use Src\Administrator\Notification\Domain\ValueObjects\NotificationFechaVencimiento;
use Src\Administrator\Notification\Domain\ValueObjects\NotificationTipo;
use Src\Administrator\Shared\Domain\Notification\NotificationId;

final class NotificationCreator
{
    private $repository;

    public function __construct(NotificationRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $clientId,
        string $descripcion,
        int $tipo,
        bool $estado,
        string $fechaVencimiento,
        int $avisoSisIs
    ): NotificationId {
        $person = Notification::create(
            new NotificationClientId($clientId),
            new NotificationDescripcion($descripcion),
            new NotificationTipo($tipo),
            new NotificationEstado($estado),
            new NotificationFechaVencimiento($fechaVencimiento),
            new NotificationAvisoSisId($avisoSisIs)
        );

        $id = $this->repository->save($person);
        $id = new NotificationId($id);

        return $id;
    }
}

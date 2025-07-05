<?php

namespace Src\Administrator\Notification\Infrastructure\Persistence\Eloquent\Repository;

use Src\Administrator\Notification\Domain\Contracts\NotificationRepositoryContract;
use Src\Administrator\Notification\Domain\Notification;

class EloquentNotificationRepository implements NotificationRepositoryContract
{
    private $eloquentNotificationModel;

    public function __construct()
    {
        $this->eloquentNotificationModel = new \App\Models\Notification();
    }
    public function save(Notification $notification): ?int {
        $newPlan = $this->eloquentNotificationModel;

        $data = [
            'cliente_id' => $notification->getClientId()->value(),
            'descripcion' => $notification->getDescription()->value(),
            'tipo' => $notification->getTipo()->value(),
            'estado' => $notification->getEstado()->value(),
            'fecha_venc' => $notification->getFechaVencimiento()->value(),
            'id_aviso_sis' => $notification->getAvisoSisId()->value(),
        ];

        return $newPlan->create($data)->id;
    }
}

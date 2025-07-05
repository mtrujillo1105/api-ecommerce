<?php

namespace Src\Administrator\AffiliateNotification\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Src\Administrator\AffiliateNotification\Domain\AffiliateNotification;
use Src\Administrator\AffiliateNotification\Domain\Contracts\AffiliateNotificationRepositoryContract;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationIdSis;

final class EloquentAffiliateNotificationRepository implements AffiliateNotificationRepositoryContract
{
    private $eloquentAffiliateNotModel;

    public function __construct()
    {
        $this->eloquentAffiliateNotModel = new \App\Models\AffiliateNotification();
    }
    public function save(AffiliateNotification $affiliateNotification): ?int
    {
        $newAffiliateNotification = $this->eloquentAffiliateNotModel;

        $data = [
            'afiliado_id' => $affiliateNotification->getAfiliadoId()->value(),
            'descripcion' => $affiliateNotification->getDescripcion()->value(),
            'clasificacion_id' => $affiliateNotification->getClasificacionId()->value(),
            'fecha_desde' => $affiliateNotification->getFechaDesde()->value(),
            'fecha_hasta' => $affiliateNotification->getFechaHasta()->value(),
            'sin_limite' => $affiliateNotification->getSinLimite()->value(),
            'estado' => $affiliateNotification->getEstado()->value(),
            'id_equiv_sis' => $affiliateNotification->getIdSis()->value()
        ];

        return $newAffiliateNotification->create($data)->id;
    }

    public function update(AffiliateNotificationIdSis $idSis, AffiliateNotification $affiliateNotification): ?int
    {
        $oldAffiliateNotification = $this->eloquentAffiliateNotModel->where('id_equiv_sis', $idSis->value())->firstOrFail();

        $data = [
            'afiliado_id' => $affiliateNotification->getAfiliadoId()->value(),
            'descripcion' => $affiliateNotification->getDescripcion()->value(),
            'clasificacion_id' => $affiliateNotification->getClasificacionId()->value(),
            'fecha_desde' => $affiliateNotification->getFechaDesde()->value(),
            'fecha_hasta' => $affiliateNotification->getFechaHasta()->value(),
            'sin_limite' => $affiliateNotification->getSinLimite()->value(),
            'estado' => $affiliateNotification->getEstado()->value(),
            'id_equiv_sis' => $affiliateNotification->getIdSis()->value()
        ];

        $oldAffiliateNotification->update($data);
        return $oldAffiliateNotification->id;
    }

    public function findByIdSis(AffiliateNotificationIdSis $idSis): ?int
    {
        try {
            $oldAffiliateNotification = $this->eloquentAffiliateNotModel->where('id_equiv_sis', $idSis->value())->firstOrFail();
            return $oldAffiliateNotification->id;
        } catch (ModelNotFoundException $e) {
            return null;
        }

    }
}

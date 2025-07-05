<?php

namespace Src\Administrator\AffiliateNotification\Application\Update;

use Src\Administrator\AffiliateNotification\Domain\AffiliateNotification;
use Src\Administrator\AffiliateNotification\Domain\Contracts\AffiliateNotificationRepositoryContract;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationAfiliadoId;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationClasificacionId;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationDescripcion;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationEstado;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationFechaDesde;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationFechaHasta;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationIdSis;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationSinLimite;
use Src\Administrator\Shared\Domain\AffiliateNotification\AffiliateNotificationId;

final class AffiliateNotificationUpdater
{
    private $repository;

    public function __construct(AffiliateNotificationRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $idSis,
        int $afiliadoId,
        string $descripcion,
        int $clasificacionId,
        bool $sinLimite,
        bool $estado,
        ?string $fechaDesde,
        ?string $fechaHasta
    ): ?AffiliateNotificationId {
        $idSis = new AffiliateNotificationIdSis($idSis);
        $affiliate = AffiliateNotification::create(
            new AffiliateNotificationAfiliadoId($afiliadoId),
            new AffiliateNotificationDescripcion($descripcion),
            new AffiliateNotificationClasificacionId($clasificacionId),
            new AffiliateNotificationFechaDesde($fechaDesde),
            new AffiliateNotificationFechaHasta($fechaHasta),
            new AffiliateNotificationSinLimite($sinLimite),
            new AffiliateNotificationEstado($estado),
            $idSis
        );
        $id = $this->repository->update($idSis, $affiliate);
        return new AffiliateNotificationId($id);
    }
}

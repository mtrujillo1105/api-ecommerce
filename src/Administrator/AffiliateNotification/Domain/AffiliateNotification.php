<?php

namespace Src\Administrator\AffiliateNotification\Domain;

use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationAfiliadoId;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationClasificacionId;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationDescripcion;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationEstado;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationFechaDesde;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationFechaHasta;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationIdSis;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationSinLimite;

class AffiliateNotification
{
    private $afiliadoId;
    private $descripcion;
    private $clasificacionId;
    private $fechaDesde;
    private $fechaHasta;
    private $sinLimite;
    private $estado;
    private $idSis;

    /**
     * @return AffiliateNotificationAfiliadoId
     */
    public function getAfiliadoId(): AffiliateNotificationAfiliadoId
    {
        return $this->afiliadoId;
    }

    /**
     * @return AffiliateNotificationDescripcion
     */
    public function getDescripcion(): AffiliateNotificationDescripcion
    {
        return $this->descripcion;
    }

    /**
     * @return AffiliateNotificationClasificacionId
     */
    public function getClasificacionId(): AffiliateNotificationClasificacionId
    {
        return $this->clasificacionId;
    }

    /**
     * @return AffiliateNotificationFechaDesde
     */
    public function getFechaDesde(): AffiliateNotificationFechaDesde
    {
        return $this->fechaDesde;
    }

    /**
     * @return AffiliateNotificationFechaHasta
     */
    public function getFechaHasta(): AffiliateNotificationFechaHasta
    {
        return $this->fechaHasta;
    }

    /**
     * @return AffiliateNotificationSinLimite
     */
    public function getSinLimite(): AffiliateNotificationSinLimite
    {
        return $this->sinLimite;
    }

    /**
     * @return AffiliateNotificationEstado
     */
    public function getEstado(): AffiliateNotificationEstado
    {
        return $this->estado;
    }

    /**
     * @return AffiliateNotificationIdSis
     */
    public function getIdSis(): AffiliateNotificationIdSis
    {
        return $this->idSis;
    }

    /**
     * @param $afiliadoId
     * @param $descripcion
     * @param $clasificacionId
     * @param $fechaDesde
     * @param $fechaHasta
     * @param $sinLimite
     * @param $estado
     * @param $idSis
     */
    public function __construct(
        AffiliateNotificationAfiliadoId $afiliadoId,
        AffiliateNotificationDescripcion $descripcion,
        AffiliateNotificationClasificacionId $clasificacionId,
        AffiliateNotificationFechaDesde $fechaDesde,
        AffiliateNotificationFechaHasta $fechaHasta,
        AffiliateNotificationSinLimite $sinLimite,
        AffiliateNotificationEstado $estado,
        AffiliateNotificationIdSis $idSis
    ) {
        $this->afiliadoId = $afiliadoId;
        $this->descripcion = $descripcion;
        $this->clasificacionId = $clasificacionId;
        $this->fechaDesde = $fechaDesde;
        $this->fechaHasta = $fechaHasta;
        $this->sinLimite = $sinLimite;
        $this->estado = $estado;
        $this->idSis = $idSis;
    }

    public static function create(
        AffiliateNotificationAfiliadoId $afiliadoId,
        AffiliateNotificationDescripcion $descripcion,
        AffiliateNotificationClasificacionId $clasificacionId,
        AffiliateNotificationFechaDesde $fechaDesde,
        AffiliateNotificationFechaHasta $fechaHasta,
        AffiliateNotificationSinLimite $sinLimite,
        AffiliateNotificationEstado $estado,
        AffiliateNotificationIdSis $idSis
    ) {
        return new self(
            $afiliadoId,
            $descripcion,
            $clasificacionId,
            $fechaDesde,
            $fechaHasta,
            $sinLimite,
            $estado,
            $idSis
        );
    }

}

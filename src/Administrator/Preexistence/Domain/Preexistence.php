<?php

namespace Src\Administrator\Preexistence\Domain;

use Src\Administrator\Preexistence\Domain\ValueObjects\PreexistenceAfiliadoId;
use Src\Administrator\Preexistence\Domain\ValueObjects\PreexistenceCieId;
use Src\Administrator\Preexistence\Domain\ValueObjects\PreexistenceDescripcion;
use Src\Administrator\Preexistence\Domain\ValueObjects\PreexistenceEstado;
use Src\Administrator\Preexistence\Domain\ValueObjects\PreexistenceFechaInicioExclusion;
use Src\Administrator\Preexistence\Domain\ValueObjects\PreexistenceMotivoExclusionId;
use Src\Administrator\Preexistence\Domain\ValueObjects\PreexistenceSisId;

final class Preexistence
{
    private $afiliadoId;
    private $cieId;
    private $motivoExclusionId;
    private $fechaInicioExclusion;
    private $descripcion;
    private $estado;
    private $idSis;

    /**
     * @return PreexistenceAfiliadoId
     */
    public function getAfiliadoId(): PreexistenceAfiliadoId
    {
        return $this->afiliadoId;
    }

    /**
     * @return PreexistenceCieId
     */
    public function getCieId(): PreexistenceCieId
    {
        return $this->cieId;
    }

    /**
     * @return PreexistenceMotivoExclusionId
     */
    public function getMotivoExclusionId(): PreexistenceMotivoExclusionId
    {
        return $this->motivoExclusionId;
    }

    /**
     * @return PreexistenceFechaInicioExclusion
     */
    public function getFechaInicioExclusion(): PreexistenceFechaInicioExclusion
    {
        return $this->fechaInicioExclusion;
    }

    /**
     * @return PreexistenceDescripcion
     */
    public function getDescripcion(): PreexistenceDescripcion
    {
        return $this->descripcion;
    }

    /**
     * @return PreexistenceEstado
     */
    public function getEstado(): PreexistenceEstado
    {
        return $this->estado;
    }

    /**
     * @return PreexistenceSisId
     */
    public function getIdSis(): PreexistenceSisId
    {
        return $this->idSis;
    }

    /**
     * @param $afiliadoId
     * @param $cieId
     * @param $motivoExclusionId
     * @param $fechaInicioExclusion
     * @param $descripcion
     * @param $estado
     * @param $idSis
     */
    public function __construct(
        PreexistenceAfiliadoId $afiliadoId,
        PreexistenceCieId $cieId,
        PreexistenceMotivoExclusionId $motivoExclusionId,
        PreexistenceFechaInicioExclusion $fechaInicioExclusion,
        PreexistenceDescripcion $descripcion,
        PreexistenceEstado $estado,
        PreexistenceSisId $idSis
    ) {
        $this->afiliadoId = $afiliadoId;
        $this->cieId = $cieId;
        $this->motivoExclusionId = $motivoExclusionId;
        $this->fechaInicioExclusion = $fechaInicioExclusion;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
        $this->idSis = $idSis;
    }

    public static function create(
        PreexistenceAfiliadoId $afiliadoId,
        PreexistenceCieId $cieId,
        PreexistenceMotivoExclusionId $motivoExclusionId,
        PreexistenceFechaInicioExclusion $fechaInicioExclusion,
        PreexistenceDescripcion $descripcion,
        PreexistenceEstado $estado,
        PreexistenceSisId $idSis
    ): Preexistence {
        return new self(
            $afiliadoId,
            $cieId,
            $motivoExclusionId,
            $fechaInicioExclusion,
            $descripcion,
            $estado,
            $idSis
        );
    }
}

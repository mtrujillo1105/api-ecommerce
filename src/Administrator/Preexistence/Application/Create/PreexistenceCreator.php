<?php

namespace Src\Administrator\Preexistence\Application\Create;

use Src\Administrator\Preexistence\Domain\Contracts\PreexistenceRepositoryContract;
use Src\Administrator\Preexistence\Domain\Preexistence;
use Src\Administrator\Preexistence\Domain\ValueObjects\PreexistenceAfiliadoId;
use Src\Administrator\Preexistence\Domain\ValueObjects\PreexistenceCieId;
use Src\Administrator\Preexistence\Domain\ValueObjects\PreexistenceDescripcion;
use Src\Administrator\Preexistence\Domain\ValueObjects\PreexistenceEstado;
use Src\Administrator\Preexistence\Domain\ValueObjects\PreexistenceFechaInicioExclusion;
use Src\Administrator\Preexistence\Domain\ValueObjects\PreexistenceMotivoExclusionId;
use Src\Administrator\Preexistence\Domain\ValueObjects\PreexistenceSisId;
use Src\Administrator\Shared\Domain\Preexistence\PreexistenceId;

final class PreexistenceCreator
{
    private $repository;

    public function __construct(PreexistenceRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $afiliadoId,
        ?int $cieId,
        ?int $motivoExclusionId,
        ?string $fechaInicioExclusion,
        string $descripcion,
        bool $estado,
        ?int $idSis,
    ): PreexistenceId {
        $newPreex = Preexistence::create(
            new PreexistenceAfiliadoId($afiliadoId),
            new PreexistenceCieId($cieId),
            new PreexistenceMotivoExclusionId($motivoExclusionId),
            new PreexistenceFechaInicioExclusion($fechaInicioExclusion),
            new PreexistenceDescripcion($descripcion),
            new PreexistenceEstado($estado),
            new PreexistenceSisId($idSis),
        );
        $id = $this->repository->save($newPreex);
        $id = new PreexistenceId($id);

        return $id;

    }
}

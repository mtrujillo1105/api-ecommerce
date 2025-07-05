<?php

namespace Src\Administrator\Preexistence\Infrastructure\Persistence\Eloquent;

use Src\Administrator\Preexistence\Domain\Contracts\PreexistenceRepositoryContract;
use Src\Administrator\Preexistence\Domain\Preexistence;

final class EloquentPreexistenceRepository implements PreexistenceRepositoryContract
{
    private $eloquentPlanModel;

    public function __construct()
    {
        $this->eloquentPlanModel = new \App\Models\Preexistence();
    }

    public function save(Preexistence $preexistence): ?int
    {
        $newPlan = $this->eloquentPlanModel;

        $data = [
            'afiliado_id' => $preexistence->getAfiliadoId()->value(),
            'cie_id' => $preexistence->getCieId()->value(),
            'motivo_exclusion_id' => $preexistence->getMotivoExclusionId()->value(),
            'fecha_inicio_exclusion' => $preexistence->getFechaInicioExclusion()->value(),
            'descripcion' => $preexistence->getDescripcion()->value(),
            'estado' => $preexistence->getEstado()->value(),
            'idSis' => $preexistence->getIdSis()->value()
        ];

        return $newPlan->create($data)->id;
    }
}

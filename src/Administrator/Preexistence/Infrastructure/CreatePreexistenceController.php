<?php

namespace Src\Administrator\Preexistence\Infrastructure;


use Illuminate\Http\Request;
use Src\Administrator\Preexistence\Application\Create\PreexistenceCreator;
use Src\Administrator\Preexistence\Infrastructure\Persistence\Eloquent\EloquentPreexistenceRepository;

final class CreatePreexistenceController
{
    private $repository;

    public function __construct(EloquentPreexistenceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {

        $afiliadoId = (int)$request->input('afiliadoId');
        $cieId = (int)$request->input('cieId');
        $motivoExclusionId = (int)$request->input('motivoExclusionId');
        $fechaInicioExclusion = $request->input('fechaInicioExclusion');
        $descripcion = $request->input('descripcion');
        $idSis = (int)$request->input('idSis');

        $newPlan = new PreexistenceCreator($this->repository);
        $planR = $newPlan->__invoke(
            $afiliadoId,
            $cieId,
            $motivoExclusionId,
            $fechaInicioExclusion,
            $descripcion,
            true,
            $idSis
        );

        return [
            'status' => true,
            'message' => 'Preexistencia creada con Id: ' . $planR->value(),
            'id' => $planR->value(),
        ];
    }

}

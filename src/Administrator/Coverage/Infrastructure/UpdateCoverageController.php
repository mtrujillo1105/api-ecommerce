<?php

declare(strict_types=1);

namespace Src\Administrator\Coverage\Infrastructure;

use Illuminate\Http\Request;

use Src\Administrator\Coverage\Application\Update\CoverageUpdater;
use Src\Administrator\Coverage\Infrastructure\Persistence\Eloquent\EloquentCoverageRepository;

use Src\Administrator\Coverage\Application\Create\CoverageCreator;

final class UpdateCoverageController
{
    private $repository;

    public function __construct(EloquentCoverageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $idCpverage, Request $request)
    {
        $codigo = $request->input('codigo');
        $descripcion = $request->input('descripcion');
        $codigoante = $request->input('codigoante');
        $codigotipo = $request->input('codigotipo');
        $codigosubt = $request->input('codigosubt');
        $tipo = $request->input('tipo');
        $descripcionsusalud = $request->input('descripcionsusalud');
        $codigoseps = $request->input('codigoseps');


        $newPlan = new CoverageUpdater($this->repository);
        $planR = $newPlan->__invoke(
            $idCpverage,
            $codigo,
            $descripcion,
            $codigoante,
            $codigotipo,
            $codigosubt,
            $tipo,
            $descripcionsusalud,
            $codigoseps
        );

        return [
            'status' => true,
            'message' => 'Cobertura actualizada con Id: ' . $planR->value(),
            'id' => $planR->value(),
        ];
    }
}

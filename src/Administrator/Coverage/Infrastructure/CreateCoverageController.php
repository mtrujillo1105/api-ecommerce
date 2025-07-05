<?php

declare(strict_types=1);

namespace Src\Administrator\Coverage\Infrastructure;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

use Src\Administrator\Coverage\Application\Get\GetCoverageByCode;
use Src\Administrator\Coverage\Infrastructure\Persistence\Eloquent\EloquentCoverageRepository;
use App\Models\Coverage;
use Src\Administrator\Coverage\Application\Create\CoverageCreator;

final class CreateCoverageController
{
    private $repository;

    public function __construct(EloquentCoverageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $codigo              = $request->input('codigo');
        $descripcion         = $request->input('descripcion');
        $codigo_ante         = $request->input('codigo_ante');
        $codigo_seps         = $request->input('codigo_seps');
        $descripcion_seps    = $request->input('descripcion_seps');
        $codigo_tipo         = $request->input('codigo_tipo');
        $codigo_subtipo      = $request->input('codigo_subtipo');
        $descripcion_susalud = $request->input('descripcion_susalud');
        $tipo                = $request->input('tipo');

        $getCoverage = new GetCoverageByCode($this->repository);
        $coverage = $getCoverage->__invoke($codigo);


        if ($coverage == null){
            $entidad = Coverage::create([       
                'codigo'                => $codigo,                    
                'descripcion'           => $descripcion,
                'codigo_ante'           => $codigo_ante,
                'codigo_seps'           => $codigo_seps,
                'descripcion_seps'      => $descripcion_seps,
                'codigo_tipo'           => $codigo_tipo,
                'codigo_subtipo'        => $codigo_subtipo,
                'descripcion_susalud'   => $descripcion_susalud,
                'tipo'                  => $tipo              
              ]);

              $id = $entidad->id; 


            if($id >0){
                return [
                    'status' => true,
                    'message' => 'Registrado'
                ];
            }else {
                return [
                    'status' => false,
                    'message' => 'No Registrado'
                ];
            }

        }else{
            $affectedRows = Coverage::where('codigo',    '=', $codigo)
            ->update([                            
                    'descripcion'           => $descripcion,
                    'codigo_ante'           => $codigo_ante,
                    'codigo_seps'           => $codigo_seps,
                    'descripcion_seps'      => $descripcion_seps,
                    'codigo_tipo'           => $codigo_tipo,
                    'codigo_subtipo'        => $codigo_subtipo,
                    'descripcion_susalud'   => $descripcion_susalud,
                    'tipo'                  => $tipo   
            // Actualiza más columnas y valores según sea necesario
            ]);

            if($affectedRows >0){
                return [
                    'status' => true,
                    'message' => 'Actualizado'
                ];
            }else {
                return [
                    'status' => false,
                    'message' => 'No actualizado'
                ];
            }
        }
       
       
    }
}

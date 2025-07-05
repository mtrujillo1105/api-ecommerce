<?php

namespace Src\Administrator\Plan\Infrastructure;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Src\Administrator\Customer\Application\Get\GetCustomerByIdEquivSis;
use Src\Administrator\Customer\Infrastructure\Persistence\Eloquent\EloquentCustomerRepository;
use Src\Administrator\Plan\Application\Get\GetPlanByIdEquivSis;
use Src\Administrator\Plan\Application\Update\PlanUpdater;
use Src\Administrator\Plan\Infrastructure\Persistence\Eloquent\EloquentPlanRepository;
use App\Models\Plan;
use Illuminate\Support\Facades\Log;
use Exception;


final class UpdatePlanController
{
    private $repository;
    private $repositoryCustomer;

    public function __construct(EloquentPlanRepository $repository)
    {
        $this->repository = $repository;
        $this->repositoryCustomer = new EloquentCustomerRepository;
    }

    public function __invoke(int $idEquivSis, Request $request)
    {



                

                $clienteId = $request->input('clienteId');
                $codigo = $request->input('codigo');
                $nombre = $request->input('nombre');
                $tipoBeneficio = $request->input('tipoBeneficio');
                $beneficioMaximo = $request->input('beneficioMaximo');
                $comentarioBenefMax = $request->input('comentarioBenefMax');
                $estado = $request->input('estado');
                $codigoPlanSs = $request->input('codigoPlanSs');
                $descripcionPlanSs = $request->input('descripcionPlanSs');
                $codigoProductoSs = $request->input('codigoProductoSs');
                $descripcionProductoSs = $request->input('descripcionProductoSs');
                $tipoPlanSs = (int)$request->input('tipoPlanSs');

                $beneficioMaximo = $beneficioMaximo ? (float)$beneficioMaximo : null;
                $comentarioBenefMax = $comentarioBenefMax ?: null;

                $codigoPlanSs = $codigoPlanSs ?: null;
                $descripcionPlanSs = $descripcionPlanSs ?: null;
                $codigoProductoSs = $codigoProductoSs ?: null;
                $descripcionProductoSs = $descripcionProductoSs ?: null;


                /** Proceso validación de Id Document Type */
                Log::info('data_request_plan_upodate', [
                    'data_request__plan_upodate' => $request->all()
                ]);

                
            
                $getCli = new GetCustomerByIdEquivSis($this->repositoryCustomer);
                // id
                $cliIdres = $getCli->__invoke($clienteId);
                //codigo
            // $codigoCliente = $getCli->__obtenerCodigoCliente($clienteId);
                    
            //  dd( $cliIdres);
                if ($cliIdres === null) {
                    throw new HttpResponseException(
                        response()->json(
                            [
                                'status' => false,
                                'message' => 'Cliente idEquivSis no existe',
                                'errors' => [
                                    'clienteId' => ['Cliente idEquivSis: ' . $idEquivSis .' - IdCliente : '.$cliIdres.' / No existe']
                                ]
                            ],
                            403
                        )
                    );
                }

                $getPlan = new GetPlanByIdEquivSis($this->repository,$cliIdres);
                $planId = $getPlan->__findPlanIafa($idEquivSis,$cliIdres);
            

                if (!$planId) {
                    throw new HttpResponseException(
                        response()->json(
                            [
                                'status' => false,
                                'message' => 'Plan idEquivSis no existe',
                                'errors' => [
                                    'idEquivSis' => ['Plan idEquivSis: ' . $idEquivSis . '-'.$planId .' No existe']
                                ]
                            ],
                            403
                        )
                    );
                }

        /*       $newPlan = new PlanUpdater($this->repository);
                $planR = $newPlan->__invoke(
                    $idEquivSis,
                    $cliIdres,
                    $codigo,
                    $nombre,
                    $estado,
                    $tipoBeneficio,
                    $beneficioMaximo,
                    $comentarioBenefMax,
                    $codigoPlanSs,
                    $descripcionPlanSs,
                    $codigoProductoSs,
                    $descripcionProductoSs,
                    $tipoPlanSs,
                );

        */
        
        try {

                $entidad      = Plan::where('id_equiv_sis',    '=', $idEquivSis)->update([
                    'cliente_id'             =>  $cliIdres,                   
                    'codigo'                 =>  $codigo,               
                    'nombre'                 =>  $nombre,               
                    'descripcion'            =>  $nombre,                
                    'tipo_beneficio_id'      =>  $tipoBeneficio,                            
                    'beneficio_maximo'       =>  $beneficioMaximo,                          
                    'comentario_benef_max'   =>  $comentarioBenefMax,                                          
//                    'codigo_ss'              =>  $codigoPlanSs,                  
//                    'nombre_ss'              =>  $descripcionPlanSs,                  
//                    'codigo_prod_ss'         =>  $codigoProductoSs,                       
//                    'nombre_prod_ss'         =>  $descripcionProductoSs,                       
                    'tipo_plan_ss_id'        =>  $tipoPlanSs,                        
                    'estado'                 =>  $estado  ,
                    'limite'                 =>  ($beneficioMaximo > 0) ? 1 : 0
                ]);

                return [
                    'status' => true,
                    'message' => 'plan actualizado con Id: ' .$idEquivSis,
                    'id' => $idEquivSis,
                ];

        }   catch(Exception $e){

            return [
                'status' => false,
                'message' => 'Error al crear el plan .ERROR :'.$e->getMessage(),
                'id' => '',
            ];

        }







    }
}

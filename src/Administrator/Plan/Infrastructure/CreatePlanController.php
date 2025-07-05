<?php

declare(strict_types=1);

namespace Src\Administrator\Plan\Infrastructure;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

use Src\Administrator\Customer\Application\Get\GetCustomerByCode;
use Src\Administrator\Customer\Application\Get\GetCustomerByIdEquivSis;
use Src\Administrator\Customer\Infrastructure\Persistence\Eloquent\EloquentCustomerRepository;
use App\Models\Plan;
use Src\Administrator\Plan\Application\Get\GetPlanByIdEquivSis;
use Src\Administrator\Plan\Infrastructure\Persistence\Eloquent\EloquentPlanRepository;
use Exception;

use Src\Administrator\Customer\Application\Get\GetCustomer;
use Src\Administrator\Plan\Application\Create\PlanCreator;
use Illuminate\Support\Facades\Log;
final class CreatePlanController
{
    private $repository;
    private $repositoryCustomer;

    public function __construct(EloquentPlanRepository $repository, EloquentCustomerRepository $customerRepository)
    {
        $this->repository = $repository;
        $this->repositoryCustomer = $customerRepository;
    }

    public function __invoke(Request $request)
    {

     
            
                $clienteId = (int)$request->input('clienteId');
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
                $tipoPlanSs = (int) $request->input('tipoPlanSs');
                $idEquivSis = (int) $request->input('idEquivSis');

                $beneficioMaximo       = $beneficioMaximo ? (float) $beneficioMaximo : null;
                $comentarioBenefMax    = $comentarioBenefMax ? $comentarioBenefMax : null;

                $codigoPlanSs          = $codigoPlanSs ? $codigoPlanSs : null;
                $descripcionPlanSs     = $descripcionPlanSs ? $descripcionPlanSs : null;
                $codigoProductoSs      = $codigoProductoSs ? $codigoProductoSs : null;
                $descripcionProductoSs = $descripcionProductoSs ? $descripcionProductoSs : null;


                Log::info('data_request_plan_create', [
                    'data_request__plan_create' => $request->all()
                ]);

                $getCli = new GetCustomerByIdEquivSis($this->repositoryCustomer);
                
                $cliIdres = $getCli->__invoke($clienteId);
            
                if ($cliIdres === null) {
                    throw new HttpResponseException(
                        response()->json(
                            [   
                                'status' => false,
                                'message' => 'Clientxe xx idEquivSis no existe',
                                'errors' => [
                                    'clienteId' => ['Cliente c idEquivSis: ' . $clienteId . ' No existe']
                                ]
                            ],
                            403
                        )
                    );
                }


            
                $getPlan = new GetPlanByIdEquivSis($this->repository, $cliIdres );



                $plan = $getPlan->__invoke($idEquivSis,$cliIdres);
                //dd($idEquivSis.'XX'.$cliIdres);
            
                if ($plan>0) {
                    throw new HttpResponseException(
                        response()->json(
                            [
                                'status' => false,
                                'message' => 'Plan idEquivSis ya existe.',
                                'errors' => [
                                    'clienteId' => ['Plan idEquivSis: ' . $idEquivSis . ' - Codigo Cliente :  ' . $idEquivSis . '  ya existe']
                                ]
                            ],
                            403
                        )
                    );
                }
        /*

                $newPlan = new PlanCreator($this->repository);
                $planR = $newPlan->__invoke(
                    $cliIdres,
                    $codigo,
                    $nombre,
                    $tipoBeneficio,
                    $beneficioMaximo,
                    $comentarioBenefMax,
                    $estado,
                    $codigoPlanSs,
                    $descripcionPlanSs,
                    $codigoProductoSs,
                    $descripcionProductoSs,
                    $tipoPlanSs,
                    $idEquivSis,
                );
        */
        try {
                    $entidad      = Plan::create([
                        'cliente_id'             =>  $cliIdres,                   
                        'codigo'                 =>  $codigo,               
                        'nombre'                 =>  $nombre,               
                        'descripcion'            =>  $nombre,                
                        'tipo_beneficio_id'      =>  $tipoBeneficio,                            
                        'beneficio_maximo'       =>  $beneficioMaximo,                          
                        'comentario_benef_max'   =>  $comentarioBenefMax,                                          
                        'codigo_ss'              =>  $codigoPlanSs,                  
                        'nombre_ss'              =>  $descripcionPlanSs,                  
                        'codigo_prod_ss'         =>  $codigoProductoSs,                       
                        'nombre_prod_ss'         =>  $descripcionProductoSs,                       
                        'tipo_plan_ss_id'        =>  $tipoPlanSs,                        
                        'estado'                 =>  $estado ,               
                        'id_equiv_sis'           =>  $idEquivSis,
                        'limite'                 =>  ($beneficioMaximo > 0) ? 1 : 0
                        // Agrega más columnas y valores según sea necesario
                    ]);

                    $id = $entidad->id;

                return [
                    'status' => true,
                    'message' => 'plan creado con Id: ' . $id,
                    'id' => $id
                ];
        }   catch(Exception $e){
         
            return [
                'status' => false,
                'message' => 'xError al crear el plan .ERROR :'.$e->getMessage(),
                'id' => '',
            ];

        }




    }
}

<?php

namespace Src\Administrator\Plandbf\Infrastructure;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Exception;
use Src\Administrator\Customer\Application\Get\GetCustomerByIdEquivSis;
use Src\Administrator\Customer\Infrastructure\Persistence\Eloquent\EloquentCustomerRepository;
use App\Models\Coverage;
use App\Models\Clinic;
use App\Models\Plandbf;
use Src\Administrator\Plan\Application\Get\GetPlanByIdEquivSis;
use Src\Administrator\Plan\Infrastructure\Persistence\Eloquent\EloquentPlanRepository;
use Src\Administrator\Plandbf\Infrastructure\Persistence\Eloquent\EloquentPlandbfRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class CreatePlandbfController
{
    private $repository;
    private $repositoryCustomer;
    private $repositoryPlan;

    public function __construct(EloquentPlandbfRepository $repository, EloquentCustomerRepository $repositoryCustomer, EloquentPlanRepository $repositoryPlan)
    {
        $this->repository = $repository;
        $this->repositoryCustomer = $repositoryCustomer;
        $this->repositoryPlan = $repositoryPlan;
    }

    public function __invoke(Request $request)
    {
        $clienteId    = $request->input('clienteId');
        $planId       = $request->input('planId');
        $coberturas   = $request->input('coberturas');

        Log::info('data_request_create', [
            'data_request_plan_dbf_create' => $request->all()
        ]);

        // CLIENTE SIS
        $getCli   = new GetCustomerByIdEquivSis($this->repositoryCustomer);
        $cliIdres = $getCli->__invoke($clienteId);
        $codigoCliente = $getCli->__obtenerCodigoCliente($clienteId);

        if ($cliIdres === null) {

            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Cliente idEquivSis no existe',
                        'errors' => [
                            'clienteId' => ['Cliente idEquivSis: ' . $clienteId . ' No existe']
                        ]
                    ],
                    403
                )
            );
        }

        $getPlan = new GetPlanByIdEquivSis($this->repositoryPlan, $cliIdres);
        $planId = $getPlan->__invoke($planId, $cliIdres);

        if ($planId === null) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Plan idEquivSis no existe',
                        'errors' => [
                            'clienteId' => ['Plan idEquivSis: ' . $planId . ' - codigoCliente: ' . $codigoCliente . ' No existe']
                        ]
                    ],
                    403
                )
            );
        }

        if (2==2){
            try {

            DB::beginTransaction();

                Plandbf::where('cliente_id',   '=', $cliIdres)
                ->where('plan_id',      '=', $planId)
                ->where('estado','=',1)
                    ->update([
                        'estado' => "0",
                        'updated_at' => now()
                    ]);

                foreach ($coberturas as $cobertura) {

                    $clinicaId         = $cobertura['clinicaId'];
                    $coberturaId       = $cobertura['coberturaId'];
                    $tipo_deducible_id = $cobertura['tipo_deducible_id'];
                    $forma_pago        = $cobertura['forma_pago'];
                    $deducible         = $cobertura['deducible'];             

                
                    $coaseguro         = $cobertura['coaseguro'];
                    $limite_cob        = $cobertura['limite_cob'];
                    $aplica_limite_cob = $cobertura['aplica_limite_cob'];
                    if (!empty($limite_cob) && $limite_cob > 0) {
                        $aplica_limite_cob = 1;
                    }
                    $genero            = $cobertura['genero'];
                    $observacion       = $cobertura['observacion'];
                    $parentesco        = $cobertura['parentesco'];
                    $fecha_inicio      = $cobertura['fecha_inicio'];
                    $fecha_fin         = $cobertura['fecha_fin'];
                    $edad_maxima       = $cobertura['edad_maxima'];
                    $mes_carencia      = $cobertura['mes_carencia'];
                    $estado            = $cobertura['estado'];
                    $id_equiv_sis      = $cobertura['id_equiv_sis'];
                    $deducible_real    = $cobertura['deducible_real'];
                    $coaseguro_real    = $cobertura['coaseguro_real'];

                    $cobertura    =  Coverage::select('id')->where("codigo", $coberturaId)->first();
                    $idCobertura  = $cobertura->id;

                    $clinica      =  Clinic::select('id')->where("codigo", $clinicaId)->first();

                    if ($clinica === null) {
                        // La clínica no se encontró en la base de datos o está vacía
                        return [
                            'status' => false,
                            'message' => 'No se encontró la clínica o está vacía. Codigo' . $clinicaId,
                            'id' => '',
                        ];
                    } else {
                        $idClinica    = $clinica->id;
                    }

                    $getIdOldPlandbf = Plandbf::where('cliente_id', $cliIdres)
                        ->where('plan_id', $planId)
                        ->where('clinica_id', $idClinica)
                        //->where('estado',  1)
                        ->where('cobertura_id', $idCobertura)
                        ->latest()
                        ->first();

                    if ($getIdOldPlandbf) {
                        $idOldPlandbf = $getIdOldPlandbf->id;
                        /*Plandbf::where('id', '=', $idOldPlandbf)
                            ->update([
                                'estado' => "0",
                                'updated_at' => now()
                            ]);*/
                    } else {
                        $idOldPlandbf = '';
                    }

                    Plandbf::create([
                        'created_at'            => now(),
                        'cliente_id'            => $cliIdres,
                        'plan_id'               => $planId,
                        'clinica_id'            => $idClinica,
                        'cobertura_id'          => $idCobertura,
                        'forma_pago'            => $forma_pago,
                        'tipo_deducible_id'     => $tipo_deducible_id,
                        'deducible'             => $deducible,
                        'coaseguro'             => $coaseguro,
                        'limite_cob'            => $limite_cob,
                        'aplica_limite_cob'     => $aplica_limite_cob,
                        'observacion'           => $observacion,
                        'genero'                => $genero,
                        'parentesco'            => $parentesco,
                        'fecha_inicio'          => $fecha_inicio,
                        'fecha_fin'             => $fecha_fin,
                        'mes_carencia'          => $mes_carencia,
                        'edad_maxima'           => $edad_maxima,
                        'estado'                => $estado,
                        'id_equiv_sis'          => $id_equiv_sis,
                        'deducible_real'        => $deducible_real,
                        'coaseguro_real'        => $coaseguro_real,
                        'plandbf_id_anterior'   => $idOldPlandbf,
                    ]);





                    // dd($idClinica ,$idCobertura,$planId,$cliIdres, );

                }


                DB::commit();


                return [
                    'status' => true,
                    'message' => 'Plandbf creado ',
                    'id' => '',
                ];
            } catch (Exception $e) {
                DB::rollback();
                return [
                    'status' => false,
                    'message' => 'Error al crear el plan de beneficios.ERROR :' . $e->getMessage(),
                    'id' => '',
                ];
            }
        }
    }
}

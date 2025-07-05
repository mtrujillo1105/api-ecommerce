<?php

declare(strict_types=1);

namespace Src\Administrator\Plan\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Plan as EloquentPlanModel;
use Src\Administrator\Plan\Domain\Contracts\PlanRepositoryContract;
use Src\Administrator\Plan\Domain\ValueObjects\PlanIdEquivSis;
use Src\Administrator\Shared\Domain\Plan\PlanId;
use Src\Administrator\Plan\Domain\Plan;

use Src\Administrator\Plan\Domain\ValueObjects\PlanClienteId;
use Src\Administrator\Plan\Domain\ValueObjects\PlanCodigo;
use Src\Administrator\Plan\Domain\ValueObjects\PlanNombre;

use Src\Administrator\Plan\Domain\ValueObjects\PlanTipoBeneficio;
use Src\Administrator\Plan\Domain\ValueObjects\PlanBeneficioMaximo;
use Src\Administrator\Plan\Domain\ValueObjects\PlanComentarioBenefMax;

use Src\Administrator\Plan\Domain\ValueObjects\PlanEstado;
use Src\Administrator\Plan\Domain\ValueObjects\PlanCodigoPlanSs;
use Src\Administrator\Plan\Domain\ValueObjects\PlanDescripcionPlanSs;

use Src\Administrator\Plan\Domain\ValueObjects\PlanCodigoProductoSs;
use Src\Administrator\Plan\Domain\ValueObjects\PlanDescripcionProductoSs;
use Src\Administrator\Plan\Domain\ValueObjects\PlanTipoPlanSs;

use Illuminate\Support\Facades\Log;


final class EloquentPlanRepository implements PlanRepositoryContract
{
    private $eloquentPlanModel;

    public function __construct()
    {
        $this->eloquentPlanModel = new EloquentPlanModel;
    }

    public function findPlan(PlanId $id): ?Plan
    {
        try {
            $plan = $this->eloquentPlanModel->findOrFail($id->value());
            return new Plan(
                new PlanClienteId($plan->clienteId),
                new PlanCodigo($plan->codigo),
                new PlanNombre($plan->nombre),
                new PlanTipoBeneficio($plan->tipoBeneficio),
                new PlanBeneficioMaximo($plan->beneficioMaximo),
                new PlanComentarioBenefMax($plan->comentarioBenefMax),
                new PlanEstado($plan->estado),
                new PlanCodigoPlanSs($plan->codigoPlanSs),
                new PlanDescripcionPlanSs($plan->descripcionPlanSs),
                new PlanCodigoProductoSs($plan->codigoProductoSs),
                new PlanDescripcionProductoSs($plan->descripcionProductoSs),
                new PlanTipoPlanSs($plan->tipoPlanSs),
                new PlanidEquivSis($plan->idEquivSis),
            );
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function save(Plan $plan): ?int
    {
        $newPlan = $this->eloquentPlanModel;

        $data = [
            'cliente_id' => $plan->clienteId()->value(),
            'codigo' => $plan->codigo()->value(),
            'nombre' => $plan->nombre()->value(),
            'tipo_beneficio' => $plan->tipoBeneficio()->value(),
            'beneficio_maximo' => $plan->beneficioMaximo()->value(),
            'comentario_benef_max' => $plan->comentarioBenefMax()->value(),
            'estado' => $plan->estado()->value(),
            'codigo_plan_ss' => $plan->codigoPlanSs()->value(),
            'descripcion_plan_ss' => $plan->descripcionPlanSs()->value(),
            'codigo_producto_ss' => $plan->codigoProductoSs()->value(),
            'descripcion_producto_ss' => $plan->descripcionProductoSs()->value(),
            'tipo_plan_ss' => $plan->tipoPlanSs()->value(),
            'id_equiv_sis' => $plan->idEquivSis()->value(),
        ];

        return $newPlan->create($data)->id;
    }

    public function update(PlanidEquivSis $idEquivSis, Plan $plan): ?int
    {
        
        try {
            $dbPlan = $this->eloquentPlanModel->where(
                                                [
                                                        'id_equiv_sis'=> $plan->idEquivSis()->value(),
                                                        'cliente_id' => $plan->clienteId()->value()
                                                ]
            )->firstOrFail();
            $data = [
                'cliente_id' => $plan->clienteId()->value(),
                'codigo' => $plan->codigo()->value(),
                'nombre' => $plan->nombre()->value(),
                'tipo_beneficio' => $plan->tipoBeneficio()->value(),
                'beneficio_maximo' => $plan->beneficioMaximo()->value(),
                'comentario_benef_max' => $plan->comentarioBenefMax()->value(),
                'estado' => $plan->estado()->value(),
                'codigo_plan_ss' => $plan->codigoPlanSs()->value(),
                'descripcion_plan_ss' => $plan->descripcionPlanSs()->value(),
                'codigo_producto_ss' => $plan->codigoProductoSs()->value(),
                'descripcion_producto_ss' => $plan->descripcionProductoSs()->value(),
                'tipo_plan_ss' => $plan->tipoPlanSs()->value(),
                'id_equiv_sis' => $plan->idEquivSis()->value(),
            ];
           
            $dbPlan->update($data);
            return $dbPlan->id;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function findPlanByCode(PlanCodigo $code): ?int
    {
        try {
            $plan = $this->eloquentPlanModel->where('codigo', $code->value())->firstOrFail();
            return $plan->id;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }



    public function findCoverage($idCoverage)
    {
        

    }
    public function findPlanByidEquivSis(PlanidEquivSis $idEquivSis, $idClient )
    {
        try {
            
            if($idClient ==  0){
                $plan = $this->eloquentPlanModel->where('id_equiv_sis',$idEquivSis->value())->firstOrFail();
                //dd($idEquivSis.'-hhhh-'. $idClient);
                return $plan->id;
            }else{
               // dd($idEquivSis.'-hhhh-'. $idClient);
                $plan = $this->eloquentPlanModel->where(
                    [
                        'id_equiv_sis'     => $idEquivSis,
                        'cliente_id' => $idClient
                    ]
                )->firstOrFail();
               
               
               
                return $plan->id;
            }
          
           
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function findPlanIafa( $idEquivSisPlan, $idClient )
    {

        
        try {

                $plan = $this->eloquentPlanModel->where(
                    [
                        'id_equiv_sis'     => $idEquivSisPlan,
                        'cliente_id' => $idClient
                    ]
                )->firstOrFail();

                return $plan->id;
                            
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}

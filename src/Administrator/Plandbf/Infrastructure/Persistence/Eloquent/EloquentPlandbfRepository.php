<?php

namespace Src\Administrator\Plandbf\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Src\Administrator\Plandbf\Domain\Contracts\PlandbfRepositoryContract;
use Src\Administrator\Plandbf\Domain\Plandbf;
use Src\Administrator\Plandbf\Domain\ValueObjects\PlandbfidEquivSis;

final class EloquentPlandbfRepository implements PlandbfRepositoryContract
{
    private $eloquentPlanModel;

    public function __construct()
    {
        $this->eloquentPlanModel = new \App\Models\Plandbf();
    }

    public function save(Plandbf $plan): ?int
    {
        $newPlan = $this->eloquentPlanModel;

        $data = [
            'cliente_id' => $plan->getClienteId()->value(),
            'clinica_id' => $plan->getClinicaId()->value(),
            'plan_id' => $plan->getPlanId()->value(),
            'cobertura_id' => $plan->getCoberturaId()->value(),
            'tipoded' => $plan->getTipoded()->value(),
            'formapago' => $plan->getFormapago()->value(),
            'deducible' => $plan->getDeducible()->value(),
            'coaseguro' => $plan->getCoaseguro()->value(),
            'limitecob' => $plan->getLimitecob()->value(),
            'observa' => $plan->getObserva()->value(),
            'parentesco' => $plan->getParentesco()->value(),
            'fini' => $plan->getFini()->value(),
            'ffin' => $plan->getFfin()->value(),
            'edad_maxima' => $plan->getEdadMaxima()->value(),
            'aplica_limitecob' => $plan->getAplicaLimitecob()->value(),
            'estado' => $plan->getEstado()->value()
        ];

        return $newPlan->create($data)->id;
    }

    public function findByidEquivSis(PlandbfidEquivSis $idEquivSis): ?int
    {
        try {
            $plan = $this->eloquentPlanModel->where('id_equiv_sis', $idEquivSis->value())->firstOrFail();
            return $plan->id;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function update(Plandbf $plan): ?int
    {
        $oldPlan = $this->eloquentPlanModel->where(
                                      [
                                       'cliente_id'    => $plan->getClienteId()->value(),
                                       'clinica_id'   => $plan->getClinicaId()->value(),
                                       'plan_id'      => $plan->getPlanId()->value(),
                                       'cobertura_id' => $plan->getCoberturaId()->value()
                                     ]
                                     ) ->firstOrFail();

        $data = [
            'cliente_id' => $plan->getClienteId()->value(),
            'clinica_id' => $plan->getClinicaId()->value(),
            'plan_id' => $plan->getPlanId()->value(),
            'cobertura_id' => $plan->getCoberturaId()->value(),
            'tipoded' => $plan->getTipoded()->value(),
            'formapago' => $plan->getFormapago()->value(),
            'deducible' => $plan->getDeducible()->value(),
            'coaseguro' => $plan->getCoaseguro()->value(),
            'limitecob' => $plan->getLimitecob()->value(),
            'observa' => $plan->getObserva()->value(),
            'parentesco' => $plan->getParentesco()->value(),
            'fini' => $plan->getFini()->value(),
            'ffin' => $plan->getFfin()->value(),
            'edad_maxima' => $plan->getEdadMaxima()->value(),
            'aplica_limitecob' => $plan->getAplicaLimitecob()->value(),
            'estado' => $plan->getEstado()->value()
        ];

        $oldPlan->update($data);
        return 1;
    }
}

<?php

declare(strict_types=1);

namespace Src\Administrator\AffiliateDetail\Infrastructure\Persistence\Eloquent;

use App\Models\AffiliateDetail as EloquentAffiliateDetailModel;
use Src\Administrator\AffiliateDetail\Domain\Contracts\AffiliateDetailRepositoryContract;
use Src\Administrator\AffiliateDetail\Domain\AffiliateDetail;

final class EloquentAffiliateDetailRepository implements AffiliateDetailRepositoryContract
{
    private $eloquentAffiliateDetailModel;

    public function __construct()
    {
        $this->eloquentAffiliateDetailModel = new EloquentAffiliateDetailModel;
    }

    public function save(AffiliateDetail $afiDet): ?int
    {
        $idAffiliate = $afiDet->afiliadoId()->value();
        $newAfiDetal = $this->eloquentAffiliateDetailModel->where('afiliado_id', $idAffiliate)->first();

        $data = [
            'afiliado_id' => $afiDet->afiliadoId()->value(),
            'programa_atencion_dental' => $afiDet->programaAtencionDental()->value(),
            'programa_especial' => $afiDet->programaEspecial()->value(),
            'fecha_inicio_programa_especial' => $afiDet->fechaInicioProgramaEspecial()->value(),
            'parentesco_petro' => $afiDet->parentescoPetro()->value(),
            'basico' => $afiDet->basico()->value(),
            'onco' => $afiDet->onco()->value(),
            'segunda_capa' => $afiDet->segundaCapa()->value(),
            'fallecido' => $afiDet->fallecido()->value(),
            'contratante' => $afiDet->contratante()->value(),

            'dependencia' => $afiDet->dependencia()->value(),
            'rol' => $afiDet->rol()->value(),
            'id_hijo' => $afiDet->idHijo()->value(),
            'documento' => $afiDet->documento()->value(),
            'afiliado' => $afiDet->afiliado()->value(),

        ];
        if ($newAfiDetal) {
            $newAfiDetal->update($data);
            return $newAfiDetal->id;
        }

        return $this->eloquentAffiliateDetailModel->create($data)->id;
    }
}

<?php

declare(strict_types=1);

namespace Src\Administrator\Affiliate\Infrastructure\Persistence\Eloquent;

use App\Models\Affiliate as EloquentAffiliateModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Src\Administrator\Affiliate\Domain\Contracts\AffiliateRepositoryContract;
use Src\Administrator\Affiliate\Domain\Affiliate;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateAfiliadoTitularId;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateCategoriaId;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateCentroCosto;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateClienteId;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateCodAfiliado;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateCodTitula;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateContrato;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateEstado;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateFechaAlta;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateFechaBaja;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateFechaContinuidad;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateFechaFinCarencia;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateFinancia;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateMotivoBajaId;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliatePersonaId;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliatePlanId;
use Src\Administrator\Person\Domain\ValueObjects\PersonNroDocumento;
use Src\Administrator\Person\Domain\ValueObjects\PersonTipoDocumentoId;

final class EloquentAffiliateRepository implements AffiliateRepositoryContract
{
    private $eloquentAffiliateModel;

    public function __construct()
    {
        $this->eloquentAffiliateModel = new EloquentAffiliateModel;
    }

    public function save(Affiliate $affiliate): ?int
    {
        $affiliateTitularId = $affiliate->afiliadoTitularId()->value();
        $idPerson = $affiliate->personaId()->value();
        $model = $this->eloquentAffiliateModel;

        $newAffiliate = $model->where('persona_id', $idPerson)->first();

        if (!$newAffiliate) {
            $newAffiliate = $model;
        }

        $newAffiliate->persona_id = $idPerson;
        $newAffiliate->cliente_id = $affiliate->clienteId()->value();
        $newAffiliate->categoria_id = $affiliate->categoriaId()->value();
        $newAffiliate->plan_id = $affiliate->planId()->value();
        //$newAffiliate->motivo_baja_id = 0;
        $newAffiliate->afiliado_titular_id = $affiliate->afiliadoTitularId()->value();
        $newAffiliate->cod_titula = $affiliate->codTitula()->value();
        $newAffiliate->centro_costo = $affiliate->centroCosto()->value();
        $newAffiliate->fecha_alta = $affiliate->fechaAlta()->value();
        $newAffiliate->fecha_baja = $affiliate->fechaBaja()->value();
        $newAffiliate->fecha_fin_carencia = $affiliate->fechaFinCarencia()->value();
        $newAffiliate->fecha_continuidad = $affiliate->fechaContinuidad()->value();
        $newAffiliate->financia = $affiliate->financia()->value();
        $newAffiliate->contrato = $affiliate->contrato()->value();
        $newAffiliate->cod_afiliado = $affiliate->codAfiliado()->value();
        $newAffiliate->estado = $affiliate->estado()->value();
        $newAffiliate->afiliado_titular_id = null;

        if (!$affiliateTitularId) {
            $newAffiliate->save();
            $newAffiliate->afiliado_titular_id = $newAffiliate->id;
            $newAffiliate->save();
        } else {
            $newAffiliate->save();
        }
        return $newAffiliate->id;
    }

    public function findMainAffiliateByContract(AffiliateContrato $contract): ?Affiliate
    {
        try {
            $affiliate = $this->eloquentAffiliateModel->where('contrato', $contract->value())->whereHas('categoria', function($q){
                $q->where('codigo', '00');
            })->firstOrFail();
            return new Affiliate(
                new AffiliatePersonaId($affiliate->persona_id),
                new AffiliateClienteId($affiliate->cliente_id),
                new AffiliateCategoriaId($affiliate->categoria_id),
                new AffiliatePlanId($affiliate->plan_id),
                new AffiliateMotivoBajaId($affiliate->motivo_baja_id),
                new AffiliateAfiliadoTitularId($affiliate->afiliado_titular_id),
                new AffiliateCodTitula($affiliate->cod_titula),
                new AffiliateCentroCosto($affiliate->centro_costo),
                new AffiliateFechaAlta($affiliate->fecha_alta),
                new AffiliateFechaBaja($affiliate->fecha_baja),
                new AffiliateFechaFinCarencia($affiliate->fecha_fin_carencia),
                new AffiliateFechaContinuidad($affiliate->fecha_continuidad),
                new AffiliateFinancia($affiliate->financia),
                new AffiliateContrato($affiliate->contrato),
                new AffiliateCodAfiliado($affiliate->cod_afiliado),
                new AffiliateEstado((int)$affiliate->estado)
            );
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function findMainAffiliateByContractAndDocument(AffiliateContrato $contract, PersonTipoDocumentoId $tipoDocumentoId, PersonNroDocumento $nroDocumento): ?Affiliate
    {
        try {
            $affiliate = $this->eloquentAffiliateModel
                ->where('contrato', $contract->value())
                ->whereHas('categoria', function($q){
                    $q->where('codigo', '00');
                })
                ->whereHas('persona', function($q) use ($tipoDocumentoId, $nroDocumento) {
                    $q->where('tipo_documento_id', $tipoDocumentoId->value())
                        ->where('nro_documento', $nroDocumento->value());
                })
                ->firstOrFail();
            return new Affiliate(
                new AffiliatePersonaId($affiliate->persona_id),
                new AffiliateClienteId($affiliate->cliente_id),
                new AffiliateCategoriaId($affiliate->categoria_id),
                new AffiliatePlanId($affiliate->plan_id),
                new AffiliateMotivoBajaId(0),
                new AffiliateAfiliadoTitularId($affiliate->afiliado_titular_id),
                new AffiliateCodTitula($affiliate->cod_titula),
                new AffiliateCentroCosto($affiliate->centro_costo),
                new AffiliateFechaAlta($affiliate->fecha_alta),
                new AffiliateFechaBaja($affiliate->fecha_baja),
                new AffiliateFechaFinCarencia($affiliate->fecha_fin_carencia),
                new AffiliateFechaContinuidad($affiliate->fecha_continuidad),
                new AffiliateFinancia($affiliate->financia),
                new AffiliateContrato($affiliate->contrato),
                new AffiliateCodAfiliado($affiliate->cod_afiliado),
                new AffiliateEstado((int)$affiliate->estado)
            );
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function findByCode(AffiliateCodAfiliado $code): ?int
    {
        try {
            $affiliate = $this->eloquentAffiliateModel->where('cod_afiliado', $code->value())->firstOrFail();
            return $affiliate->id;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}

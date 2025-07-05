<?php

declare(strict_types=1);

namespace Src\Administrator\Affiliate\Application\Create;

use Src\Administrator\Affiliate\Domain\Contracts\AffiliateRepositoryContract;
use Src\Administrator\Affiliate\Domain\Affiliate;

use Src\Administrator\Shared\Domain\Affiliate\AffiliateId;

use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliatePersonaId;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateClienteId;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateCategoriaId;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliatePlanId;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateMotivoBajaId;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateAfiliadoTitularId;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateCodTitula;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateCentroCosto;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateFechaAlta;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateFechaBaja;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateFechaFinCarencia;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateFechaContinuidad;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateFinancia;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateContrato;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateCodAfiliado;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateEstado;


final class AffiliateCreator
{
    private $repository;

    public function __construct(AffiliateRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $personaId,
        int $clienteId,
        int $categoriaId,
        int $planId,
        int $motivoBajaId,
        ?int $afiliadoTitularId,

        string $codTitula,
        string $centroCosto,

        string $fechaAlta,
        ?string $fechaBaja,
        ?string $fechaFinCarencia,
        ?string $fechaContinuidad,

        string $financia,
        string $contrato,
        string $codAfiliado,

        int $estado

    ): AffiliateId {

        $personaId = new AffiliatePersonaId($personaId);
        $clienteId = new AffiliateClienteId($clienteId);
        $categoriaId = new AffiliateCategoriaId($categoriaId);
        $planId = new AffiliatePlanId($planId);
        $motivoBajaId = new AffiliateMotivoBajaId($motivoBajaId);
        $afiliadoTitularId = new AffiliateAfiliadoTitularId($afiliadoTitularId);
        $codTitula = new AffiliateCodTitula($codTitula);
        $centroCosto = new AffiliateCentroCosto($centroCosto);
        $fechaAlta = new AffiliateFechaAlta($fechaAlta);
        $fechaBaja = new AffiliateFechaBaja($fechaBaja);
        $fechaFinCarencia = new AffiliateFechaFinCarencia($fechaFinCarencia);
        $fechaContinuidad = new AffiliateFechaContinuidad($fechaContinuidad);
        $financia = new AffiliateFinancia($financia);
        $contrato = new AffiliateContrato($contrato);
        $codAfiliado = new AffiliateCodAfiliado($codAfiliado);
        $estado = new AffiliateEstado($estado);

        $affiliate = Affiliate::create(
            $personaId,
            $clienteId,
            $categoriaId,
            $planId,
            $motivoBajaId,
            $afiliadoTitularId,
            $codTitula,
            $centroCosto,
            $fechaAlta,
            $fechaBaja,
            $fechaFinCarencia,
            $fechaContinuidad,
            $financia,
            $contrato,
            $codAfiliado,
            $estado,
        );

        $id = $this->repository->save($affiliate);
        $id = new AffiliateId($id);

        return $id;
    }
}

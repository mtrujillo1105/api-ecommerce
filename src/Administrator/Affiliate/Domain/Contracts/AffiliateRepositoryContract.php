<?php

declare(strict_types=1);

namespace Src\Administrator\Affiliate\Domain\Contracts;

use Src\Administrator\Affiliate\Domain\Affiliate;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateCodAfiliado;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateContrato;
use Src\Administrator\Person\Domain\ValueObjects\PersonNroDocumento;
use Src\Administrator\Person\Domain\ValueObjects\PersonTipoDocumentoId;

interface AffiliateRepositoryContract
{
    public function save(Affiliate $afiliate): ?int;
    public function findByCode(AffiliateCodAfiliado $code): ?int;
    public function findMainAffiliateByContract(AffiliateContrato $contract): ?Affiliate;
    public function findMainAffiliateByContractAndDocument(AffiliateContrato $contract, PersonTipoDocumentoId $tipoDocumentoId, PersonNroDocumento $nroDocumento): ?Affiliate;
}

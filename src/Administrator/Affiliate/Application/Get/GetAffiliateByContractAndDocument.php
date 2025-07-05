<?php

namespace Src\Administrator\Affiliate\Application\Get;

use Src\Administrator\Affiliate\Domain\Affiliate;
use Src\Administrator\Affiliate\Domain\Contracts\AffiliateRepositoryContract;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateContrato;
use Src\Administrator\Person\Domain\ValueObjects\PersonNroDocumento;
use Src\Administrator\Person\Domain\ValueObjects\PersonTipoDocumentoId;

final class GetAffiliateByContractAndDocument
{
    private $repository;

    public function __construct(AffiliateRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $contract, int $idDocumentType, string $documentNumber): ?Affiliate
    {
        $contract = new AffiliateContrato($contract);
        $idDocumentType = new PersonTipoDocumentoId($idDocumentType);
        $documentNumber = new PersonNroDocumento($documentNumber);
        return $this->repository->findMainAffiliateByContractAndDocument($contract, $idDocumentType, $documentNumber);
    }
}

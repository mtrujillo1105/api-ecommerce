<?php

namespace Src\Administrator\Affiliate\Application\Get;

use Src\Administrator\Affiliate\Domain\Affiliate;
use Src\Administrator\Affiliate\Domain\Contracts\AffiliateRepositoryContract;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateContrato;

final class GetAffiliateByContract
{
    private $repository;

    public function __construct(AffiliateRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $contract): ?Affiliate
    {
        $contract = new AffiliateContrato($contract);
        return $this->repository->findMainAffiliateByContract($contract);
    }
}

<?php

namespace Src\Administrator\Affiliate\Application\Get;

use Src\Administrator\Affiliate\Domain\Contracts\AffiliateRepositoryContract;
use Src\Administrator\Affiliate\Domain\ValueObjects\AffiliateCodAfiliado;

final class GetAffiliateByCode
{
    private $repository;

    public function __construct(AffiliateRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $codigo): ?int
    {
        $contract = new AffiliateCodAfiliado($codigo);
        return $this->repository->findByCode($contract);
    }
}

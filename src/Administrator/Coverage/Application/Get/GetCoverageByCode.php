<?php

namespace Src\Administrator\Coverage\Application\Get;

use Src\Administrator\Coverage\Domain\Contracts\CoverageRepositoryContract;
use Src\Administrator\Coverage\Domain\Coverage;
use Src\Administrator\Coverage\Domain\ValueObjects\CoverageCodigo;

final class GetCoverageByCode
{
    private $repository;

    public function __construct(CoverageRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $code): ?Coverage
    {
        $code = new CoverageCodigo($code);
        return $this->repository->findByCode($code);
    }
}

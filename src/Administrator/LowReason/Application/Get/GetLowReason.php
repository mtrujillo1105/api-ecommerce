<?php

declare(strict_types=1);

namespace Src\Administrator\LowReason\Application\Get;

use Src\Administrator\LowReason\Domain\Contracts\LowReasonRepositoryContract;
use Src\Administrator\LowReason\Domain\LowReason;
use Src\Administrator\Shared\Domain\LowReason\LowReasonId;

final class GetLowReason
{
    private $repository;

    public function __construct(LowReasonRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?LowReason
    {
        $id = new LowReasonId($id);
        $Lr = $this->repository->findLowReason($id);
        return $Lr;
    }
}

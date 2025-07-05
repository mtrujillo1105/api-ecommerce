<?php

declare(strict_types=1);

namespace Src\Administrator\LowReason\Domain\Contracts;

use Src\Administrator\LowReason\Domain\LowReason;
use Src\Administrator\Shared\Domain\LowReason\LowReasonId;

interface LowReasonRepositoryContract
{
    public function findLowReason(LowReasonId $id): ?LowReason;
    public function save(LowReason $motivoRazon): void;
}

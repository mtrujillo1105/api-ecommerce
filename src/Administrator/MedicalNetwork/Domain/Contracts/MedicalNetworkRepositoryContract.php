<?php

declare(strict_types=1);

namespace Src\Administrator\MedicalNetwork\Domain\Contracts;

use Src\Administrator\MedicalNetwork\Domain\MedicalNetwork;
use Src\Administrator\Shared\Domain\MedicalNetwork\MedicalNetworkId;

interface MedicalNetworkRepositoryContract
{
    public function findMedicalNetwork(MedicalNetworkId $id): ?MedicalNetwork;
}

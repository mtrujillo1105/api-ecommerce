<?php

declare(strict_types=1);

namespace Src\Administrator\MedicalNetwork\Application\Get;

use Src\Administrator\MedicalNetwork\Domain\Contracts\MedicalNetworkRepositoryContract;
use Src\Administrator\MedicalNetwork\Domain\MedicalNetwork;
use Src\Administrator\Shared\Domain\MedicalNetwork\MedicalNetworkId;

final class GetMedicalNetwork
{
    private $repository;

    public function __construct(MedicalNetworkRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?MedicalNetwork
    {
        $id = new MedicalNetworkId($id);
        $medNet = $this->repository->findMedicalNetwork($id);
        return $medNet;
    }
}

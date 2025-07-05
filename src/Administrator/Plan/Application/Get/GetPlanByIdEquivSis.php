<?php

declare(strict_types=1);

namespace Src\Administrator\Plan\Application\Get;

use Src\Administrator\Plan\Domain\Contracts\PlanRepositoryContract;
use Src\Administrator\Plan\Domain\Plan;
use Src\Administrator\Plan\Domain\ValueObjects\PlanCodigo;
use Src\Administrator\Plan\Domain\ValueObjects\PlanIdEquivSis;
use Src\Administrator\Shared\Domain\Plan\PlanId;

use Illuminate\Support\Facades\Log;

final class GetPlanByIdEquivSis
{
    private $repository;
    private $idClient;

    public function __construct(PlanRepositoryContract $repository,$idClient = 0)
    {
        $this->repository = $repository;
        $this->idClient   = $idClient;
    }

    public function __invoke(int $idEquivSis, $idClient = 0)
    {        
        $idEquivSis = new PlanidEquivSis($idEquivSis);
      
        return $this->repository->findPlanByIdEquivSis($idEquivSis,$idClient);
    }


    public function __getCoverage($codigoCobertura)
    {        
        Log::error('__getCobertura', [ "codigoCobertura" =>  $codigoCobertura ]);
        return $this->repository->findCoverage($codigoCobertura);
    }

    public function  __findPlanIafa( $idEquivSisPlan, $idClient )
    {        
        return $this->repository->findPlanIafa($idEquivSisPlan, $idClient);
    }



   
}

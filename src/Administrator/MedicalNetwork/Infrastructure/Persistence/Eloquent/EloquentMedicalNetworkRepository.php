<?php

declare(strict_types=1);

namespace Src\Administrator\MedicalNetwork\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\MedicalNetwork as EloquentMedicalNetworkModel;
use Src\Administrator\MedicalNetwork\Domain\Contracts\MedicalNetworkRepositoryContract;
use Src\Administrator\Shared\Domain\MedicalNetwork\MedicalNetworkId;
use Src\Administrator\MedicalNetwork\Domain\MedicalNetwork;

use Src\Administrator\MedicalNetwork\Domain\ValueObjects\MedicalNetworkNombre;


final class EloquentMedicalNetworkRepository implements MedicalNetworkRepositoryContract
{
    private $eloquentMedicalNetworkModel;

    public function __construct()
    {
        $this->eloquentMedicalNetworkModel = new EloquentMedicalNetworkModel;
    }

    public function findMedicalNetwork(MedicalNetworkId $id): ?MedicalNetwork
    {
        try {
            $medNet = $this->eloquentMedicalNetworkModel->findOrFail($id->value());
            return new MedicalNetwork(
                new MedicalNetworkNombre($medNet->nombre),
            );
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}

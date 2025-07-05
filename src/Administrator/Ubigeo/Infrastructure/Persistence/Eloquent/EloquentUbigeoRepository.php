<?php

declare(strict_types=1);

namespace Src\Administrator\Ubigeo\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Ubigeo as EloquentUbigeoModel;
use Src\Administrator\Ubigeo\Domain\Contracts\UbigeoRepositoryContract;

use Src\Administrator\Shared\Domain\Ubigeo\UbigeoId;
use Src\Administrator\Ubigeo\Domain\Ubigeo;

use Src\Administrator\Ubigeo\Domain\ValueObjects\UbigeoUbigeo;
use Src\Administrator\Ubigeo\Domain\ValueObjects\UbigeoDepartamento;
use Src\Administrator\Ubigeo\Domain\ValueObjects\UbigeoProvincia;
use Src\Administrator\Ubigeo\Domain\ValueObjects\UbigeoDistrito;

final class EloquentUbigeoRepository implements UbigeoRepositoryContract
{
    private $eloquentUbigeoModel;

    public function __construct()
    {
        $this->eloquentUbigeoModel = new EloquentUbigeoModel;
    }

    public function findUbigeo(UbigeoId $id): ?Ubigeo
    {
        try {
            $ubig = $this->eloquentUbigeoModel->findOrFail($id->value());
            return new Ubigeo(
                new UbigeoUbigeo($ubig->ubigeo),
                new UbigeoDepartamento($ubig->departamento),
                new UbigeoProvincia($ubig->provincia),
                new UbigeoDistrito($ubig->distrito),
            );
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function save(Ubigeo $ubigeo): void
    {
    }

    public function findUbigeoByCode(UbigeoUbigeo $code): ?int
    {
        try {
            $ubig = $this->eloquentUbigeoModel->where('ubigeo', $code->value())->firstOrFail();
            return $ubig->id;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}

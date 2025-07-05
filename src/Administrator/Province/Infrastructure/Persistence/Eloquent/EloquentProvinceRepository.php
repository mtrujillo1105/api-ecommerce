<?php

declare(strict_types=1);

namespace Src\Administrator\Province\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Province as EloquentProvinceModel;
use Src\Administrator\Province\Domain\Contracts\ProvinceRepositoryContract;
use Src\Administrator\Province\Domain\ValueObjects\ProvinceCodigo;
use Src\Administrator\Shared\Domain\Province\ProvinceId;
use Src\Administrator\Province\Domain\Province;
use Src\Administrator\Province\Domain\ValueObjects\ProvinceNombre;
use Src\Administrator\Province\Domain\ValueObjects\ProvinceDepartamentoId;


final class EloquentProvinceRepository implements ProvinceRepositoryContract
{
    private $eloquentProvinceModel;

    public function __construct()
    {
        $this->eloquentProvinceModel = new EloquentProvinceModel;
    }

    public function findProvince(ProvinceId $id): ?Province
    {
        try {
            $docType = $this->eloquentProvinceModel->findOrFail($id->value());
            return new Province(
                new ProvinceNombre($docType->name),
                new ProvinceDepartamentoId($docType->departamentoId)
            );
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function save(Province $docType): void
    {
    }

    public function findProvinceByCode(ProvinceCodigo $code): ?int
    {
        try {
            $docType = $this->eloquentProvinceModel->where('codigo', $code->value())->firstOrFail();
            return $docType->id;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}

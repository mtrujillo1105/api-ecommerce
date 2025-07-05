<?php

declare(strict_types=1);

namespace Src\Administrator\District\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\District as EloquentDistrictModel;
use Src\Administrator\District\Domain\Contracts\DistrictRepositoryContract;
use Src\Administrator\District\Domain\ValueObjects\DistrictCode;
use Src\Administrator\Shared\Domain\District\DistrictId;
use Src\Administrator\District\Domain\District;
use Src\Administrator\District\Domain\ValueObjects\DistrictNombre;
use Src\Administrator\District\Domain\ValueObjects\DistrictProvinciaId;


final class EloquentDistrictRepository implements DistrictRepositoryContract
{
    private $eloquentDistrictModel;

    public function __construct()
    {
        $this->eloquentDistrictModel = new EloquentDistrictModel;
    }

    public function findDistrict(DistrictId $id): ?District
    {
        try {
            $distc = $this->eloquentDistrictModel->findOrFail($id->value());
            return new District(
                new DistrictNombre($distc->name),
                new DistrictProvinciaId($distc->provinciaId)
            );
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function save(District $distc): void
    {
    }

    public function findDistrictByCode(DistrictCode $code): ?int
    {
        try {
            $distc = $this->eloquentDistrictModel->where('codigo', $code->value())->firstOrFail();
            return $distc->id;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}

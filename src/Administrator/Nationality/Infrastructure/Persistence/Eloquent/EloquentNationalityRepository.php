<?php

declare(strict_types=1);

namespace Src\Administrator\Nationality\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Nationality as EloquentNationalityModel;
use Src\Administrator\Nationality\Domain\Contracts\NationalityRepositoryContract;
use Src\Administrator\Shared\Domain\Nationality\NationalityId;
use Src\Administrator\Nationality\Domain\Nationality;

use Src\Administrator\Nationality\Domain\ValueObjects\NationalityCodigo;
use Src\Administrator\Nationality\Domain\ValueObjects\NationalityPais;
use Src\Administrator\Nationality\Domain\ValueObjects\NationalityGentilicio;


final class EloquentNationalityRepository implements NationalityRepositoryContract
{
    private $eloquentNationalityModel;

    public function __construct()
    {
        $this->eloquentNationalityModel = new EloquentNationalityModel;
    }

    public function findNationality(NationalityId $id): ?Nationality
    {
        try {
            $catg = $this->eloquentNationalityModel->findOrFail($id->value());
            return new Nationality(
                new NationalityCodigo($catg->codigo),
                new NationalityPais($catg->pais),
                new NationalityGentilicio($catg->gentilicio),
            );
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function save(Nationality $distc): void
    {
    }
}

<?php

declare(strict_types=1);

namespace Src\Administrator\PersonDetail\Infrastructure\Persistence\Eloquent;

// use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\PersonDetail as EloquentPersonDetailModel;

use Src\Administrator\PersonDetail\Domain\Contracts\PersonDetailRepositoryContract;
use Src\Administrator\PersonDetail\Domain\PersonDetail;

final class EloquentPersonDetailRepository implements PersonDetailRepositoryContract
{
    private $eloquentPersonDetailModel;

    public function __construct()
    {
        $this->eloquentPersonDetailModel = new EloquentPersonDetailModel;
    }

    public function save(PersonDetail $persond): ?int
    {
        $idPerson = $persond->personaId()->value();
        $newPersonD = $this->eloquentPersonDetailModel->where('persona_id', $idPerson)->first();

        $data = [
            'persona_id' => $idPerson,
            'departamento_id' => $persond->departamentoId()->value(),
            'provincia_id' => $persond->provinciaId()->value(),
            'distrito_id' => $persond->distritoId()->value(),
            'nacionalidad_id' => $persond->nacionalidadId()->value(),
            'direccion' => $persond->direccion()->value(),
            'email' => $persond->email()->value(),
            'telefono' => $persond->telefono()->value(),
            'foto' => $persond->foto()->value(),
            'peso' => $persond->peso()->value(),
            'estatura' => $persond->estatura()->value(),
            'discapacitado' => $persond->discapacitado()->value(),
            'consume_alcohol' => $persond->consumeAlcohol()->value(),
            'consume_drogas' => $persond->consumeDrogas()->value(),
            'grupo_sanguineo' => $persond->grupoSanguineo()->value(),
        ];

        if ($newPersonD) {
            $newPersonD->update($data);
            return $newPersonD->id;
        }

        return $this->eloquentPersonDetailModel->create($data)->id;
    }
}

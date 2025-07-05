<?php

declare(strict_types=1);

namespace Src\Administrator\Person\Infrastructure\Persistence\Eloquent;

use App\Models\Person as EloquentPersonModel;
use Src\Administrator\Person\Domain\Contracts\PersonRepositoryContract;
use Src\Administrator\Person\Domain\Person;

final class EloquentPersonRepository implements PersonRepositoryContract
{
    private $eloquentPersonModel;

    public function __construct()
    {
        $this->eloquentPersonModel = new EloquentPersonModel;
    }

    public function save(Person $person): ?int
    {
        $idTipoDocumento = $person->tipoDocumentoId()->value();
        $nroDocumento = $person->nroDocumento()->value();

        $newPerson = $this->eloquentPersonModel
            ->where('tipo_documento_id', $idTipoDocumento)
            ->where('nro_documento', $nroDocumento)
            ->first();
        $data = [
            'ape_paterno' => $person->apePaterno()->value(),
            'ape_materno' => $person->apeMaterno()->value(),
            'nombre' => $person->nombre()->value(),
            'razon_social' => $person->razonSocial()->value(),
            'tipo_persona_id' => $person->tipoPersonaId()->value(),
            'tipo_documento_id' => $idTipoDocumento,
            'estado_civil_id' => $person->estadoCivilId()->value(),
            'nro_documento' => $person->nroDocumento()->value(),
            'fecha_nacimiento' => $person->fechaNacimiento()->value(),
            'sexo' => $person->sexo()->value()
        ];
        if ($newPerson) {
            $newPerson->update($data);
            return $newPerson->id;
        }
        return $this->eloquentPersonModel->create($data)->id;
    }
}

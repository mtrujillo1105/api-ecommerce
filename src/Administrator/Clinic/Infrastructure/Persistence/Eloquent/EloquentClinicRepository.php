<?php

declare(strict_types=1);

namespace Src\Administrator\Clinic\Infrastructure\Persistence\Eloquent;

use App\Models\Clinic as EloquentClinicModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Src\Administrator\Clinic\Domain\Contracts\ClinicRepositoryContract;
use Src\Administrator\Clinic\Domain\Clinic;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicAcceso;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicCodigo;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicDireccion;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicEmail;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicEntVinculada;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicEstado;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicIgv;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicIpress;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicNombre;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicRedMedicaId;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicRenipress;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicRuc;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicSede;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicTelefono;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicTipo;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicUbicacion;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicUbigeoId;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicUsuarioId;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicZona;

final class EloquentClinicRepository implements ClinicRepositoryContract
{
    private $eloquentClinicModel;

    public function __construct()
    {
        $this->eloquentClinicModel = new EloquentClinicModel;
    }

    public function save(Clinic $clinic): ?int
    {
        $newClinic = $this->eloquentClinicModel;

        $data = [
            'usuario_id' => $clinic->usuarioId()->value(),
            'codigo' => $clinic->codigo()->value(),
            'red_medica_id' => $clinic->redMedicaId()->value(),
            'ubigeo_id' => $clinic->ubigeoId()->value(),
            'nombre' => $clinic->nombre()->value(),
            'ruc' => $clinic->ruc()->value(),
            'telefono' => $clinic->telefono()->value(),
            'email' => $clinic->email()->value(),
            'direccion' => $clinic->direccion()->value(),
            'tipo' => $clinic->tipo()->value(),
            'acceso' => $clinic->acceso()->value(),
            'ent_vinculada' => $clinic->entVinculada()->value(),
            'ipress' => $clinic->ipress()->value(),
            'renipress' => $clinic->renipress()->value(),
            'estado' => $clinic->estado()->value(),
            'zona' => $clinic->zona()->value(),
            'igv' => $clinic->igv()->value(),
            'sede' => $clinic->sede()->value(),
            'ubicacion' => $clinic->ubicacion()->value(),
        ];

        return $newClinic->create($data)->id;
    }

    public function findByCode(ClinicCodigo $code): ?Clinic
    {
        try {
            $clinic = $this->eloquentClinicModel->where('codigo', $code->value())->firstOrFail();
            return new Clinic(
                new ClinicUsuarioId($clinic->usuarioId),
                new ClinicCodigo($clinic->codigo),
                new ClinicRedMedicaId($clinic->redMedicaId),
                new ClinicUbigeoId($clinic->ubigeoId),
                new ClinicNombre($clinic->nombre),
                new ClinicRuc($clinic->ruc),
                new ClinicTelefono($clinic->telefono),
                new ClinicEmail($clinic->email),
                new ClinicDireccion($clinic->direccion),
                new ClinicTipo($clinic->tipo),
                new ClinicAcceso($clinic->acceso),
                new ClinicEntVinculada($clinic->entVinculada),
                new ClinicIpress($clinic->ipress),
                new ClinicRenipress($clinic->renipress),
                new ClinicEstado($clinic->estado),
                new ClinicZona($clinic->zona),
                new ClinicIgv($clinic->igv),
                new ClinicSede($clinic->sede),
                new ClinicUbicacion($clinic->ubicacion),
            );
        } catch (ModelNotFoundException $exception) {
            return null;
        }
    }
}

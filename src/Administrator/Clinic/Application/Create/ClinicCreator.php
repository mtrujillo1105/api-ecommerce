<?php

declare(strict_types=1);

namespace Src\Administrator\Clinic\Application\Create;

use Src\Administrator\Clinic\Domain\Contracts\ClinicRepositoryContract;
use Src\Administrator\Clinic\Domain\Clinic;

use Src\Administrator\Clinic\Domain\ValueObjects\ClinicUsuarioId;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicCodigo;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicRedMedicaId;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicUbigeoId;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicNombre;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicRuc;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicTelefono;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicEmail;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicDireccion;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicTipo;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicAcceso;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicAsignacionConcubina;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicDependencia;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicEntVinculada;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicIpress;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicRenipress;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicEstado;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicZona;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicIgv;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicRol;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicSede;
use Src\Administrator\Clinic\Domain\ValueObjects\ClinicUbicacion;

use Src\Administrator\Shared\Domain\Clinic\ClinicId;

final class ClinicCreator
{
    private $repository;

    public function __construct(ClinicRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $usuarioId,
        string $codigo,
        ?int $redMedicaId,
        int $ubigeoId,
        string $nombre,
        string $ruc,
        ?string $telefono,
        ?string $email,
        ?string $direccion,
        string $tipo,
        ?string $acceso,
        ?string $entVinculada,
        ?string $ipress,
        ?string $renipress,
        string $estado,
        ?string $zona,
        string $igv,
        ?string $sede,
        ?string $ubicacion,
        ?string $rol,
        ?string $dependencia,
        ?string $asignacion_concubina,
    ): ClinicId {


        $usuarioId = new ClinicUsuarioId($usuarioId);
        $codigo = new ClinicCodigo($codigo);
        $redMedicaId = new ClinicRedMedicaId($redMedicaId);
        $ubigeoId = new ClinicUbigeoId($ubigeoId);
        $nombre = new ClinicNombre($nombre);
        $ruc = new ClinicRuc($ruc);
        $telefono = new ClinicTelefono($telefono);
        $email = new ClinicEmail($email);
        $direccion = new ClinicDireccion($direccion);
        $tipo = new ClinicTipo($tipo);
        $acceso = new ClinicAcceso($acceso);
        $entVinculada = new ClinicEntVinculada($entVinculada);
        $ipress = new ClinicIpress($ipress);
        $renipress = new ClinicRenipress($renipress);
        $estado = new ClinicEstado($estado);
        $zona = new ClinicZona($zona);
        $igv = new ClinicIgv($igv);
        $sede = new ClinicSede($sede);
        $ubicacion = new ClinicUbicacion($ubicacion);
        $rol = new ClinicRol($rol);
        $dependencia = new ClinicDependencia($dependencia);
        $asignacion_concubina = new ClinicAsignacionConcubina($asignacion_concubina);

        $person = Clinic::create(
            $usuarioId,
            $codigo,
            $redMedicaId,
            $ubigeoId,
            $nombre,
            $ruc,
            $telefono,
            $email,
            $direccion,
            $tipo,
            $acceso,
            $entVinculada,
            $ipress,
            $renipress,
            $estado,
            $zona,
            $igv,
            $sede,
            $ubicacion,
            $rol,
            $dependencia,
            $asignacion_concubina,
        );

        $id = $this->repository->save($person);
        $id = new ClinicId($id);

        return $id;
    }
}

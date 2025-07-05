<?php

declare(strict_types=1);

namespace Src\Administrator\PersonDetail\Application\Create;

use Src\Administrator\PersonDetail\Domain\Contracts\PersonDetailRepositoryContract;
use Src\Administrator\PersonDetail\Domain\PersonDetail;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailPersonaId;
use Src\Administrator\Shared\Domain\PersonDetail\PersonDetailId;

use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailDepartamentoId;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailProvinciaId;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailDistritoId;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailNacionalidadId;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailDireccion;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailEmail;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailTelefono;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailFoto;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailPeso;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailEstatura;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailDiscapacitado;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailConsumeAlcohol;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailConsumeDrogas;
use Src\Administrator\PersonDetail\Domain\ValueObjects\PersonDetailGrupoSanguineo;



final class PersonDetailCreator
{
    private $repository;

    public function __construct(PersonDetailRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $personaId,
        int $departamentoId,
        int $provinciaId,
        int $distritoId,
        int $nacionalidadId,
        ?string $direccion,
        ?string $email,
        ?string $telefono,
        ?string $foto,
        ?float $peso,
        ?float $estatura,
        ?string $discapacitado,
        ?string $consumeAlcohol,
        ?string $consumeDrogas,
        ?string $grupoSanguineo,
    ): PersonDetailId {

        $personaId = new PersonDetailPersonaId($personaId);
        $departamentoId = new PersonDetailDepartamentoId($departamentoId);
        $provinciaId = new PersonDetailProvinciaId($provinciaId);
        $distritoId = new PersonDetailDistritoId($distritoId);
        $nacionalidadId = new PersonDetailNacionalidadId($nacionalidadId);
        $direccion = new PersonDetailDireccion($direccion);
        $email = new PersonDetailEmail($email);
        $telefono = new PersonDetailTelefono($telefono);
        $foto = new PersonDetailFoto($foto);
        $peso = new PersonDetailPeso($peso);
        $estatura = new PersonDetailEstatura($estatura);
        $discapacitado = new PersonDetailDiscapacitado($discapacitado);
        $consumeAlcohol = new PersonDetailConsumeAlcohol($consumeAlcohol);
        $consumeDrogas = new PersonDetailConsumeDrogas($consumeDrogas);
        $grupoSanguineo = new PersonDetailGrupoSanguineo($grupoSanguineo);

        $personD = PersonDetail::create(
            $personaId,
            $departamentoId,
            $provinciaId,
            $distritoId,
            $nacionalidadId,
            $direccion,
            $email,
            $telefono,
            $foto,
            $peso,
            $estatura,
            $discapacitado,
            $consumeAlcohol,
            $consumeDrogas,
            $grupoSanguineo,
        );

        $id = $this->repository->save($personD);
        $id = new PersonDetailId($id);

        return $id;
    }
}

<?php

declare(strict_types=1);

namespace Src\Administrator\Person\Application\Create;

use Src\Administrator\Person\Domain\Contracts\PersonRepositoryContract;
use Src\Administrator\Person\Domain\Person;
use Src\Administrator\Person\Domain\ValueObjects\PersonApeMaterno;
use Src\Administrator\Person\Domain\ValueObjects\PersonApePaterno;
use Src\Administrator\Person\Domain\ValueObjects\PersonEstadoCivilId;
use Src\Administrator\Person\Domain\ValueObjects\PersonFechaNacimiento;
use Src\Administrator\Person\Domain\ValueObjects\PersonNombre;
use Src\Administrator\Person\Domain\ValueObjects\PersonNroDocumento;
use Src\Administrator\Person\Domain\ValueObjects\PersonRazonSocial;
use Src\Administrator\Person\Domain\ValueObjects\PersonSexo;
use Src\Administrator\Person\Domain\ValueObjects\PersonTipoDocumentoId;
use Src\Administrator\Person\Domain\ValueObjects\PersonTipoPersonaId;
use Src\Administrator\Shared\Domain\Person\PersonId;

final class PersonCreator
{
    private $repository;

    public function __construct(PersonRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        ?string $apePaterno,
        ?string $apeMaterno,
        ?string $nombre,
        ?string $razonSocial,
        int $tipoPersonaId,
        int $tipoDocumentoId,
        int $estadoCivilId,
        string $nroDocumento,
        string $fechaNacimiento,
        string $sexo,
        // ): Person {
    ): PersonId {

        $apePaterno = new PersonApePaterno($apePaterno);
        $apeMaterno = new PersonApeMaterno($apeMaterno);
        $nombre = new PersonNombre($nombre);
        $razonSocial = new PersonRazonSocial($razonSocial);
        $tipoPersonaId = new PersonTipoPersonaId($tipoPersonaId);
        $tipoDocumentoId = new PersonTipoDocumentoId($tipoDocumentoId);
        $estadoCivilId = new PersonEstadoCivilId($estadoCivilId);
        $nroDocumento = new PersonNroDocumento($nroDocumento);
        $fechaNacimiento = new PersonFechaNacimiento($fechaNacimiento);
        $sexo = new PersonSexo($sexo);

        $person = Person::create(
            $apePaterno,
            $apeMaterno,
            $nombre,
            $razonSocial,
            $tipoPersonaId,
            $tipoDocumentoId,
            $estadoCivilId,
            $nroDocumento,
            $fechaNacimiento,
            $sexo,
        );

        $id = $this->repository->save($person);
        $id = new PersonId($id);

        // return $person;
        return $id;
    }
}

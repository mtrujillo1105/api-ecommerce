<?php

declare(strict_types=1);

namespace Src\Administrator\Person\Infrastructure;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

use Src\Administrator\CivilStatus\Infrastructure\Persistence\Eloquent\EloquentCivilStatusRepository;
use Src\Administrator\DocumentType\Infrastructure\Persistence\Eloquent\EloquentDocumentTypeRepository;
use Src\Administrator\PersonType\Infrastructure\Persistence\Eloquent\EloquentPersonTypeRepository;
use Src\Administrator\Person\Infrastructure\Persistence\Eloquent\EloquentPersonRepository;

use Src\Administrator\CivilStatus\Application\Get\GetCivilStatus;
use Src\Administrator\DocumentType\Application\Get\GetDocumentType;
use Src\Administrator\PersonType\Application\Get\GetPersonType;
use Src\Administrator\Person\Application\Create\PersonCreator;

final class CreatePersonController
{
    private $repository;
    private $repositoryDocType;
    private $repositoryPerType;
    private $repositoryCivilSt;

    public function __construct(EloquentPersonRepository $repository)
    {
        $this->repository = $repository;
        $this->repositoryDocType = new EloquentDocumentTypeRepository;
        $this->repositoryPerType = new EloquentPersonTypeRepository;
        $this->repositoryCivilSt = new EloquentCivilStatusRepository;
    }

    public function __invoke(Request $request)
    {
        $apePaterno = $request->input('apePaterno');
        $apeMaterno = $request->input('apeMaterno');
        $nombre = $request->input('nombre');
        $razonSocial = $request->input('razonSocial');

        $tipoPersonaId = $request->input('tipoPersonaId');
        $tipoDocumentoId = $request->input('tipoDocumentoId');
        $estadoCivilId = $request->input('estadoCivilId');
        $nroDocumento = $request->input('nroDocumento');
        $fechaNacimiento = $request->input('fechaNacimiento');
        $sexo = $request->input('sexo');

        // echo "apePaterno->" . $apePaterno;
        $apePaterno = $apePaterno ? $apePaterno : null;
        // echo "apePaterno2->" . $apePaterno;
        $apeMaterno = $apeMaterno ? $apeMaterno : null;
        $nombre = $nombre ? $nombre : null;
        $razonSocial = $razonSocial ? $razonSocial : null;

        $tipoPersonaId = (int) $tipoPersonaId;
        $tipoDocumentoId = (int) $tipoDocumentoId;
        $estadoCivilId = (int) $estadoCivilId;


        /** Proceso validación de Id Document Type */
        $getDocType = new GetDocumentType($this->repositoryDocType);

        $docType = $getDocType->__invoke($tipoDocumentoId);
        if ($docType === null) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Tipo Documento Id no existe',
                        'errors' => [
                            'tipoDocumentoId' => ['Tipo Documento Id: ' . $tipoDocumentoId . ' No existe']
                        ]
                    ],
                    403
                )
            );
        }

        /** Proceso validación de Id Person Type */
        $getPersonType = new GetPersonType($this->repositoryPerType);

        $perType = $getPersonType->__invoke($tipoPersonaId);
        if ($perType === null) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Tipo Persona Id no existe',
                        'errors' => [
                            'tipoPersonId' => ['Tipo Persona Id: ' . $tipoPersonaId . ' No existe']
                        ]
                    ],
                    403
                )
            );
        }


        /** Proceso validación de Id Civil status */
        $getCivilSt = new GetCivilStatus($this->repositoryCivilSt);

        $civilSt = $getCivilSt->__invoke($estadoCivilId);
        if ($civilSt === null) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Estado Civil Id no existe',
                        'errors' => [
                            'estadoCivilId' => ['Estado Civil Id: ' . $estadoCivilId . ' no existe']
                        ]
                    ],
                    403
                )
            );
        }

        $newPerson = new PersonCreator($this->repository);
        $Person = $newPerson->__invoke(
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

        return [
            'status' => true,
            'message' => 'Persona creada con Id: ' . $Person->value(),
            'id' => $Person->value(),
        ];
    }
}

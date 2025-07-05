<?php

namespace Src\Administrator\Notification\Infrastructure\Persistence;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Src\Administrator\Customer\Application\Get\GetCustomer;
use Src\Administrator\Customer\Application\Get\GetCustomerByCode;
use Src\Administrator\Customer\Infrastructure\Persistence\Eloquent\EloquentCustomerRepository;
use Src\Administrator\Notification\Application\Create\NotificationCreator;
use Src\Administrator\Notification\Infrastructure\Persistence\Eloquent\Repository\EloquentNotificationRepository;

class CreateNotificationController
{
    private $repository;
    private $repositoryCustomer;

    public function __construct(EloquentNotificationRepository $repository)
    {
        $this->repository = $repository;
        $this->repositoryCustomer = new EloquentCustomerRepository;

    }

    public function __invoke(Request $request)
    {

        $codigoCliente = (int)$request->input('codigoCliente');
        $descripcion = $request->input('descripcion');
        $tipo = (int)$request->input('tipo');
        $fechaVenc = $request->input('fechaVencimiento');
        $avisoSisIs = $request->input('avisoSisId');

        $getCli = new GetCustomerByCode($this->repositoryCustomer);

        $cliIdres = $getCli->__invoke($codigoCliente);
        if ($cliIdres === null) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Cliente codigo no existe',
                        'errors' => [
                            'clienteId' => ['Cliente codigo: ' . $codigoCliente . ' No existe']
                        ]
                    ],
                    403
                )
            );
        }

        $newNot = new NotificationCreator($this->repository);
        $not = $newNot->__invoke(
            $cliIdres,
            $descripcion,
            $tipo,
            true,
            $fechaVenc,
            $avisoSisIs
        );

        return [
            'status' => true,
            'message' => 'Aviso creado con Id: ' . $not->value(),
            'id' => $not->value(),
        ];
    }
}

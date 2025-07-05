<?php

declare(strict_types=1);

namespace Src\Administrator\Customer\Infrastructure;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Src\Administrator\Customer\Application\Create\CustomerCreator;
use Src\Administrator\Customer\Application\Get\GetCustomerByIdEquivSis;
use Src\Administrator\Customer\Application\Get\GetCustomerByIdSis;
use Src\Administrator\Customer\Infrastructure\Persistence\Eloquent\EloquentCustomerRepository;
use Illuminate\Support\Facades\Log;


final class CreateCustomerController
{
    private $repository;

    public function __construct(EloquentCustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        // try catch
        $codigo = $request->input('codigo');
        $nombre = $request->input('nombre');
        $nombreCorto = $request->input('nombreCorto');
        $ruc = $request->input('ruc');
        $codIafa = $request->input('codIafa');
        $estado = $request->input('estado');
        $idSis = $request->input('idSis');


        
        Log::info('data_request_cliente_create', [
            'data_request__cliente_create' => $request->all()
        ]);


        // validate de Id Motivo Baja
        $getMoRe = new GetCustomerByIdEquivSis($this->repository);

        $motBId = $getMoRe->__invoke($idSis);
        if ($motBId) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Cliente ya existe',
                        'errors' => [
                            'idSis' => ['IdSis: ' . $idSis . ' ya existe']
                        ]
                    ],
                    403
                )
            );
        }

        $newCustomer = new CustomerCreator($this->repository);
        $customer = $newCustomer->__invoke(
            $codigo,
            $nombre,
            $nombreCorto,
            $ruc,
            $codIafa,
            $estado,
            $idSis
        );

        return [
            'status' => true,
            'message' => 'Cliente creado con Id: ' . $customer->value(),
            'id' => $customer->value(),
        ];
    }
}

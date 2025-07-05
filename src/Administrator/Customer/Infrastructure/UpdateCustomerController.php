<?php

declare(strict_types=1);

namespace Src\Administrator\Customer\Infrastructure;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Src\Administrator\Customer\Application\Get\GetCustomerByIdEquivSis;
use Src\Administrator\Customer\Application\Update\CustomerUpdater;
use Src\Administrator\Customer\Infrastructure\Persistence\Eloquent\EloquentCustomerRepository;
use Illuminate\Support\Facades\Log;

final class UpdateCustomerController
{
    private $repository;

    public function __construct(EloquentCustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $idSis, Request $request)
    {
        // try catch
        $codigo = $request->input('codigo');
        $nombre = $request->input('nombre');
        $nombreCorto = $request->input('nombreCorto');
        $ruc = $request->input('ruc');
        $codIafa = $request->input('codIafa');
        $estado = $request->input('estado');
        $idEquivSis = $idSis;

        $getClientModel = new GetCustomerByIdEquivSis($this->repository);
       
        Log::info('data_request_cliente_update', [
            'data_request__cliente_update' => $request->all()
        ]);



        $id = $getClientModel->__invoke($idSis);
        if (!$id) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Cliente no existe',
                        'errors' => [
                            'idSis' => ['IdSis: ' . $idSis . ' no existe']
                        ]
                    ],
                    403
                )
            );
        }
        $newCustomer = new CustomerUpdater($this->repository);
        $customer = $newCustomer->__invoke(
            $id,
            $codigo,
            $nombre,
            $nombreCorto,
            $ruc,
            $codIafa,
            $estado,
            $idEquivSis
        );

        return [
            'status' => true,
            'message' => 'Cliente actualizado con Id: ' . $customer->value(),
            'id' => $customer->value(),
        ];    
    
    }
}

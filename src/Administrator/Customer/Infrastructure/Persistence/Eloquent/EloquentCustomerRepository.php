<?php

declare(strict_types=1);

namespace Src\Administrator\Customer\Infrastructure\Persistence\Eloquent;

use App\Models\Customer as EloquentCustomerModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Src\Administrator\Customer\Domain\Customer;
use Src\Administrator\Customer\Domain\Contracts\CustomerRepositoryContract;
use Src\Administrator\Customer\Domain\ValueObjects\CustomerCodIafa;
use Src\Administrator\Customer\Domain\ValueObjects\CustomerCodigo;
use Src\Administrator\Customer\Domain\ValueObjects\CustomerEstado;
use Src\Administrator\Customer\Domain\ValueObjects\CustomerIdEquivSis;
use Src\Administrator\Customer\Domain\ValueObjects\CustomerNombre;
use Src\Administrator\Customer\Domain\ValueObjects\CustomerNombreCorto;
use Src\Administrator\Customer\Domain\ValueObjects\CustomerRuc;
use Src\Administrator\Shared\Domain\Customer\CustomerId;

use Illuminate\Support\Facades\Log;


final class EloquentCustomerRepository implements CustomerRepositoryContract
{
    private $eloquentCustomerModel;

    public function __construct()
    {
        $this->eloquentCustomerModel = new EloquentCustomerModel;
    }

    public function findCustomer(CustomerId $id): ?Customer
    {
        try {
            $docType = $this->eloquentCustomerModel->findOrFail($id->value());
            return new Customer(
                new CustomerCodigo($docType->codigo),
                new CustomerNombre($docType->nombre),
                new CustomerNombreCorto($docType->nombreCorto),
                new CustomerRuc($docType->ruc),
                new CustomerCodIafa($docType->codIafa),
                new CustomerEstado($docType->estado),
                new CustomerIdEquivSis($docType->idEquivSis),
            );
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function save(Customer $customer): ?int
    {
        $newCustomer = $this->eloquentCustomerModel;

        $data = [
            'codigo' => $customer->codigo()->value(),
            'nombre' => $customer->nombre()->value(),
            'nombre_corto' => $customer->nombreCorto()->value(),
            'ruc' => $customer->ruc()->value(),
            'cod_iafa' => $customer->codIafa()->value(),
            'estado' => $customer->estado()->value(),
            'id_equiv_sis' => $customer->idEquivSis()->value(),
        ];

        return $newCustomer->create($data)->id;
    }

    public function findCustomerByCode(CustomerCodigo $codigo): ?int
    {
     
        try {
            $docType = $this->eloquentCustomerModel->where('codigo', '=', $codigo->value())->firstOrFail();
            return $docType->id;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function findCustomerByidEquivSis(CustomerIdEquivSis $codigo): ?int
    {
        try {
            $docType = $this->eloquentCustomerModel->where('id_equiv_sis', '=', $codigo->value())->firstOrFail();
           // Log::error('nombre', ["FCUSTOMER : " => $codigo->value(), "entro"]);
            //Log::error('nombre', [$$codigo->value(), $e->getLine()]);
            return $docType->id;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }


    public function findCustomerByidEquivSisgetCodigo(CustomerIdEquivSis $codigo)
    {
        try {
            $docType = $this->eloquentCustomerModel->where('id_equiv_sis', '=', $codigo->value())->firstOrFail();
           // Log::error('nombre', ["FCUSTOMER : " => $codigo->value(), "entro"]);
            //Log::error('nombqvqweqwvqevqevqevqre', ["dax" =>$codigo->value()]);
            return $docType->codigo;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function update(int $id, Customer $customer): ?int
    {
        $newCustomer = $this->eloquentCustomerModel->findOrFail($id);

        $data = [
            'codigo' => $customer->codigo()->value(),
            'nombre' => $customer->nombre()->value(),
            'nombre_corto' => $customer->nombreCorto()->value(),
            'ruc' => $customer->ruc()->value(),
            'cod_iafa' => $customer->codIafa()->value(),
            'estado' => $customer->estado()->value(),
            'idEquivSis' => $customer->idEquivSis()->value(),
        ];

        $newCustomer->update($data);
        return $id;
    }
}

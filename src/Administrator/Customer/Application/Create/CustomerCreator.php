<?php

declare(strict_types=1);

namespace Src\Administrator\Customer\Application\Create;

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

final class CustomerCreator
{
    private $repository;

    public function __construct(CustomerRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $codigo,
        string $nombre,
        string $nombreCorto,
        string $ruc,
        string $codIafa,
        string $estado,
        ?int $idEquivSis
        // ): void {
    ): CustomerId {

        $codigo = new CustomerCodigo($codigo);
        $nombre = new CustomerNombre($nombre);
        $nombreCorto = new CustomerNombreCorto($nombreCorto);
        $ruc = new CustomerRuc($ruc);
        $codIafa = new CustomerCodIafa($codIafa);
        $estado = new CustomerEstado($estado);
        $idEquivSis = new CustomerIdEquivSis($idEquivSis);

        $customer = Customer::create(
            $codigo,
            $nombre,
            $nombreCorto,
            $ruc,
            $codIafa,
            $estado,
            $idEquivSis ,
        );
        $id = $this->repository->save($customer);

        return new CustomerId($id);
    }
}

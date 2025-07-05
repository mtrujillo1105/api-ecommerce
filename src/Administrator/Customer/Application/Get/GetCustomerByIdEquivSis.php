<?php

declare(strict_types=1);

namespace Src\Administrator\Customer\Application\Get;

use Src\Administrator\Customer\Domain\Contracts\CustomerRepositoryContract;
use Src\Administrator\Customer\Domain\ValueObjects\CustomerIdEquivSis;
final class GetCustomerByIdEquivSis
{
    private $repository;

    public function __construct(CustomerRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?int
    {
        $id = new CustomerIdEquivSis($id);
        return $this->repository->findCustomerByidEquivSis($id);
    }

    public function __obtenerCodigoCliente(int $id)
    {
        $id = new CustomerIdEquivSis($id);
        return $this->repository->findCustomerByidEquivSisgetCodigo($id);
    }
}

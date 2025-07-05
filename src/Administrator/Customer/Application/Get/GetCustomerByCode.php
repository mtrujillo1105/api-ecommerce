<?php

declare(strict_types=1);

namespace Src\Administrator\Customer\Application\Get;

use Src\Administrator\Customer\Domain\Contracts\CustomerRepositoryContract;
use Src\Administrator\Customer\Domain\Customer;
use Src\Administrator\Customer\Domain\ValueObjects\CustomerCodigo;
use Src\Administrator\Shared\Domain\Customer\CustomerId;

final class GetCustomerByCode
{
    private $repository;

    public function __construct(CustomerRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id): ?int
    {
        $id = new CustomerCodigo($id);
        return $this->repository->findCustomerByCode($id);
    }
}

<?php

declare(strict_types=1);

namespace Src\Administrator\Customer\Application\Get;

use Src\Administrator\Customer\Domain\Contracts\CustomerRepositoryContract;
use Src\Administrator\Customer\Domain\Customer;
use Src\Administrator\Shared\Domain\Customer\CustomerId;

final class GetCustomer
{
    private $repository;

    public function __construct(CustomerRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?Customer
    {
        $id = new CustomerId($id);
        $civS = $this->repository->findCustomer($id);
        return $civS;
    }
}

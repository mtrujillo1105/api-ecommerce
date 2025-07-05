<?php

declare(strict_types=1);

namespace Src\Administrator\Customer\Domain\Contracts;

use Src\Administrator\Customer\Domain\Customer;
use Src\Administrator\Customer\Domain\ValueObjects\CustomerCodigo;
use Src\Administrator\Customer\Domain\ValueObjects\CustomerIdEquivSis;
use Src\Administrator\Shared\Domain\Customer\CustomerId;

interface CustomerRepositoryContract
{
    public function findCustomer(CustomerId $id): ?Customer;
    public function findCustomerByCode(CustomerCodigo $codigo): ?int;
    public function findCustomerByidEquivSis(CustomerIdEquivSis $codigo): ?int;
    public function findCustomerByidEquivSisgetCodigo(CustomerIdEquivSis $codigo);    
    public function save(Customer $customer): ?int;
    public function update(int $id, Customer $customer): ?int;
}

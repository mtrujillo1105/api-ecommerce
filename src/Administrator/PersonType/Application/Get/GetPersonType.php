<?php

declare(strict_types=1);

namespace Src\Administrator\PersonType\Application\Get;

use Src\Administrator\PersonType\Domain\Contracts\PersonTypeRepositoryContract;
use Src\Administrator\PersonType\Domain\PersonType;
use Src\Administrator\Shared\Domain\PersonType\PersonTypeId;

final class GetPersonType
{
    private $repository;

    public function __construct(PersonTypeRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?PersonType
    {
        $id = new PersonTypeId($id);
        $docType = $this->repository->findPersonType($id);
        return $docType;
    }
}

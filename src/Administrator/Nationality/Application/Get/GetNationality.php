<?php

declare(strict_types=1);

namespace Src\Administrator\Nationality\Application\Get;

use Src\Administrator\Nationality\Domain\Contracts\NationalityRepositoryContract;
use Src\Administrator\Nationality\Domain\Nationality;
use Src\Administrator\Shared\Domain\Nationality\NationalityId;

final class GetNationality
{
    private $repository;

    public function __construct(NationalityRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?Nationality
    {
        $id = new NationalityId($id);
        $Lr = $this->repository->findNationality($id);
        return $Lr;
    }
}

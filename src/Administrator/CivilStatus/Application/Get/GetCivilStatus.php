<?php

declare(strict_types=1);

namespace Src\Administrator\CivilStatus\Application\Get;

use Src\Administrator\CivilStatus\Domain\Contracts\CivilStatusRepositoryContract;
use Src\Administrator\CivilStatus\Domain\CivilStatus;
use Src\Administrator\Shared\Domain\CivilStatus\CivilStatusId;

final class GetCivilStatus
{
    private $repository;

    public function __construct(CivilStatusRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?CivilStatus
    {
        $id = new CivilStatusId($id);
        $civS = $this->repository->findCivilStatus($id);
        return $civS;
    }
}

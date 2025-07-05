<?php

declare(strict_types=1);

namespace Src\Administrator\Ubigeo\Application\Get;

use Src\Administrator\Ubigeo\Domain\Contracts\UbigeoRepositoryContract;
use Src\Administrator\Ubigeo\Domain\Ubigeo;
use Src\Administrator\Shared\Domain\Ubigeo\UbigeoId;

final class GetUbigeo
{
    private $repository;

    public function __construct(UbigeoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?Ubigeo
    {
        $id = new UbigeoId($id);
        $ubig = $this->repository->findUbigeo($id);
        return $ubig;
    }
}

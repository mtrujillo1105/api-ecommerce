<?php

declare(strict_types=1);

namespace Src\Administrator\Ubigeo\Application\Get;

use Src\Administrator\Ubigeo\Domain\Contracts\UbigeoRepositoryContract;
use Src\Administrator\Ubigeo\Domain\Ubigeo;
use Src\Administrator\Shared\Domain\Ubigeo\UbigeoId;
use Src\Administrator\Ubigeo\Domain\ValueObjects\UbigeoUbigeo;

final class GetUbigeoByCode
{
    private $repository;

    public function __construct(UbigeoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $code): UbigeoId
    {
        $code = new UbigeoUbigeo($code);
        $id = $this->repository->findUbigeoByCode($code);
        return new UbigeoId($id);
    }
}

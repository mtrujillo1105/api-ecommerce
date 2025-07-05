<?php

declare(strict_types=1);

namespace Src\Administrator\Ubigeo\Domain\Contracts;

use Src\Administrator\Ubigeo\Domain\Ubigeo;
use Src\Administrator\Shared\Domain\Ubigeo\UbigeoId;
use Src\Administrator\Ubigeo\Domain\ValueObjects\UbigeoUbigeo;

interface UbigeoRepositoryContract
{
    public function findUbigeo(UbigeoId $id): ?Ubigeo;
    public function findUbigeoByCode(UbigeoUbigeo $code): ?int;
    public function save(Ubigeo $categoria): void;
}

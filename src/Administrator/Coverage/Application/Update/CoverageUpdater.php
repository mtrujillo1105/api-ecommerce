<?php

namespace Src\Administrator\Coverage\Application\Update;

use Src\Administrator\Coverage\Domain\Contracts\CoverageRepositoryContract;
use Src\Administrator\Coverage\Domain\Coverage;
use Src\Administrator\Coverage\Domain\ValueObjects\CoverageCodigo;
use Src\Administrator\Coverage\Domain\ValueObjects\CoverageCodigoante;
use Src\Administrator\Coverage\Domain\ValueObjects\CoverageCodigoSeps;
use Src\Administrator\Coverage\Domain\ValueObjects\CoverageCodigoSubt;
use Src\Administrator\Coverage\Domain\ValueObjects\CoverageCodigoTipo;
use Src\Administrator\Coverage\Domain\ValueObjects\CoverageDescripcion;
use Src\Administrator\Coverage\Domain\ValueObjects\CoverageDescripcionSuSalud;
use Src\Administrator\Coverage\Domain\ValueObjects\CoverageTipo;
use Src\Administrator\Shared\Domain\Coverage\CoverageId;

final class CoverageUpdater
{
    private $repository;

    public function __construct(CoverageRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $id,
        string $codigo,
        string $descripcion,
        ?string $codigoante,
        ?string $codigotipo,
        ?string $codigosubt,
        ?string $tipo,
        ?string $descripcionsusalud,
        ?string $codigoseps
    ): CoverageId {

        $person = Coverage::create(
            new CoverageCodigo($codigo),
            new CoverageDescripcion($descripcion),
            new CoverageCodigoante($codigoante),
            new CoverageCodigoTipo($codigotipo),
            new CoverageCodigoSubt($codigosubt),
            new CoverageTipo($tipo),
            new CoverageDescripcionSuSalud($descripcionsusalud),
            new CoverageCodigoSeps($codigoseps),
        );

        $this->repository->update($id, $person);
        return new CoverageId($id);
    }
}

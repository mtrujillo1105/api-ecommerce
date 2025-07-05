<?php

namespace Src\Administrator\Coverage\Infrastructure\Persistence\Eloquent;

use App\Models\Coverage as EloquentCoverageModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

class EloquentCoverageRepository implements CoverageRepositoryContract
{
    private $eloquentPlanModel;

    public function __construct()
    {
        $this->eloquentPlanModel = new EloquentCoverageModel;
    }


    public function save(Coverage $coverage): ?int
    {
        $newPlan = $this->eloquentPlanModel;

        $data = [
            'codigo' => $coverage->getCodigo()->value(),
            'descripcion' => $coverage->getDescripcion()->value(),
            'codigoante' => $coverage->getCodigoante()->value(),
            'codigotipo' => $coverage->getCodigotipo()->value(),
            'codigosubt' => $coverage->getCodigosubt()->value(),
            'tipo' => $coverage->getTipo()->value(),
            'descripcion_susalud' => $coverage->getDescripcionsusalud()->value(),
            'codigoseps' => $coverage->getCodigoseps()->value()
        ];

        return $newPlan->create($data)->id;
    }

    public function update(int $id, Coverage $coverage): ?int
    {
        $newPlan = $this->eloquentPlanModel->findOrFail($id);

        $data = [
            'codigo' => $coverage->getCodigo()->value(),
            'descripcion' => $coverage->getDescripcion()->value(),
            'codigoante' => $coverage->getCodigoante()->value(),
            'codigotipo' => $coverage->getCodigotipo()->value(),
            'codigosubt' => $coverage->getCodigosubt()->value(),
            'tipo' => $coverage->getTipo()->value(),
            'descripcion_susalud' => $coverage->getDescripcionsusalud()->value(),
            'codigoseps' => $coverage->getCodigoseps()->value()
        ];

        $newPlan->update($data);
        return $id;
    }

    public function findByCode(string $code): ?Coverage
    {
        try {
            $coverage = $this->eloquentPlanModel->where('codigo', $code)->firstOrFail();

            return new Coverage(
                new CoverageCodigo($coverage->codigo),
                new CoverageDescripcion($coverage->descripcion),
                new CoverageCodigoante($coverage->codigoante),
                new CoverageCodigoTipo($coverage->codigotipo),
                new CoverageCodigoSubt($coverage->codigosubt),
                new CoverageTipo($coverage->tipo),
                new CoverageDescripcionSuSalud($coverage->descripcionsusalud),
                new CoverageCodigoSeps($coverage->codigoseps)
            );
        } catch (ModelNotFoundException $exception) {
            return null;
        }
    }
}

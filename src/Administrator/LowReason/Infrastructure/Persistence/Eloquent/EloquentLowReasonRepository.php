<?php

declare(strict_types=1);

namespace Src\Administrator\LowReason\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\LowReason as EloquentLowReasonModel;
use Src\Administrator\LowReason\Domain\Contracts\LowReasonRepositoryContract;
use Src\Administrator\Shared\Domain\LowReason\LowReasonId;
use Src\Administrator\LowReason\Domain\LowReason;

use Src\Administrator\LowReason\Domain\ValueObjects\LowReasonEstado;
use Src\Administrator\LowReason\Domain\ValueObjects\LowReasonDescripcion;


final class EloquentLowReasonRepository implements LowReasonRepositoryContract
{
    private $eloquentLowReasonModel;

    public function __construct()
    {
        $this->eloquentLowReasonModel = new EloquentLowReasonModel;
    }

    public function findLowReason(LowReasonId $id): ?LowReason
    {
        try {
            $catg = $this->eloquentLowReasonModel->findOrFail($id->value());
            return new LowReason(
                new LowReasonDescripcion($catg->descripcion),
                new LowReasonEstado($catg->estado),
            );
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function save(LowReason $distc): void
    {
    }
}

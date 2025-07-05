<?php

declare(strict_types=1);

namespace Src\Administrator\AffiliateDetail\Application\Create;

use Src\Administrator\AffiliateDetail\Domain\Contracts\AffiliateDetailRepositoryContract;
use Src\Administrator\AffiliateDetail\Domain\AffiliateDetail;

use Src\Administrator\AffiliateDetail\Domain\ValueObjects\AffiliateDetailAfiliadoId;
use Src\Administrator\AffiliateDetail\Domain\ValueObjects\AffiliateDetailProgramaAtencionDental;
use Src\Administrator\AffiliateDetail\Domain\ValueObjects\AffiliateDetailProgramaEspecial;
use Src\Administrator\AffiliateDetail\Domain\ValueObjects\AffiliateDetailFechaInicioProgramaEspecial;
use Src\Administrator\AffiliateDetail\Domain\ValueObjects\AffiliateDetailParentescoPetro;
use Src\Administrator\AffiliateDetail\Domain\ValueObjects\AffiliateDetailBasico;
use Src\Administrator\AffiliateDetail\Domain\ValueObjects\AffiliateDetailOnco;
use Src\Administrator\AffiliateDetail\Domain\ValueObjects\AffiliateDetailSegundaCapa;
use Src\Administrator\AffiliateDetail\Domain\ValueObjects\AffiliateDetailFallecido;
use Src\Administrator\AffiliateDetail\Domain\ValueObjects\AffiliateDetailContratante;

use Src\Administrator\AffiliateDetail\Domain\ValueObjects\AffiliateDetailDependencia;
use Src\Administrator\AffiliateDetail\Domain\ValueObjects\AffiliateDetailRol;
use Src\Administrator\AffiliateDetail\Domain\ValueObjects\AffiliateDetailIdHijo;
use Src\Administrator\AffiliateDetail\Domain\ValueObjects\AffiliateDetailDocumento;
use Src\Administrator\AffiliateDetail\Domain\ValueObjects\AffiliateDetailAfiliado;


use Src\Administrator\Shared\Domain\AffiliateDetail\AffiliateDetailId;


final class AffiliateDetailCreator
{
    private $repository;

    public function __construct(AffiliateDetailRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $afiliadoId,
        string $programaAtencionDental,
        string $programaEspecial,
        ?string $fechaInicioProgramaEspecial,
        ?string $parentescoPetro,
        string $basico,
        string $onco,
        string $segundaCapa,
        int $fallecido,
        int $contratante,

        string $dependencia,
        string $rol,
        string $idHijo,
        string $documento,
        string $afiliado,

    ): AffiliateDetailId {
        $afiliadoId =  new AffiliateDetailAfiliadoId($afiliadoId);
        $programaAtencionDental =  new AffiliateDetailProgramaAtencionDental($programaAtencionDental);
        $programaEspecial =  new AffiliateDetailProgramaEspecial($programaEspecial);
        $fechaInicioProgramaEspecial =  new AffiliateDetailFechaInicioProgramaEspecial($fechaInicioProgramaEspecial);
        $parentescoPetro =  new AffiliateDetailParentescoPetro($parentescoPetro);
        $basico =  new AffiliateDetailBasico($basico);
        $onco =  new AffiliateDetailOnco($onco);
        $segundaCapa =  new AffiliateDetailSegundaCapa($segundaCapa);
        $fallecido =  new AffiliateDetailFallecido($fallecido);
        $contratante =  new AffiliateDetailContratante($contratante);

        $dependencia = new AffiliateDetailDependencia($dependencia);
        $rol = new AffiliateDetailRol($rol);
        $idHijo = new AffiliateDetailIdHijo($idHijo);
        $documento = new AffiliateDetailDocumento($documento);
        $afiliado = new AffiliateDetailAfiliado($afiliado);

        $afiDet = AffiliateDetail::create(
            $afiliadoId,
            $programaAtencionDental,
            $programaEspecial,
            $fechaInicioProgramaEspecial,
            $parentescoPetro,
            $basico,
            $onco,
            $segundaCapa,
            $fallecido,
            $contratante,

            $dependencia,
            $rol,
            $idHijo,
            $documento,
            $afiliado,
        );

        $id = $this->repository->save($afiDet);
        $id = new AffiliateDetailId($id);

        return $id;
    }
}

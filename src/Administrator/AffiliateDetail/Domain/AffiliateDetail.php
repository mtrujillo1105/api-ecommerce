<?php

declare(strict_types=1);

namespace Src\Administrator\AffiliateDetail\Domain;

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

final class AffiliateDetail
{
    private $afiliadoId;
    private $programaAtencionDental;
    private $programaEspecial;
    private $fechaInicioProgramaEspecial;
    private $parentescoPetro;
    private $basico;
    private $onco;
    private $segundaCapa;
    private $fallecido;
    private $contratante;

    private $dependencia;
    private $rol;
    private $idHijo;
    private $documento;
    private $afiliado;


    public function __construct(
        AffiliateDetailAfiliadoId $afiliadoId,
        AffiliateDetailProgramaAtencionDental $programaAtencionDental,
        AffiliateDetailProgramaEspecial $programaEspecial,
        AffiliateDetailFechaInicioProgramaEspecial $fechaInicioProgramaEspecial,
        AffiliateDetailParentescoPetro $parentescoPetro,
        AffiliateDetailBasico $basico,
        AffiliateDetailOnco $onco,
        AffiliateDetailSegundaCapa $segundaCapa,
        AffiliateDetailFallecido $fallecido,
        AffiliateDetailContratante $contratante,

        AffiliateDetailDependencia $dependencia,
        AffiliateDetailRol $rol,
        AffiliateDetailIdHijo $idHijo,
        AffiliateDetailDocumento $documento,
        AffiliateDetailAfiliado $afiliado,
    ) {
        $this->afiliadoId = $afiliadoId;
        $this->programaAtencionDental = $programaAtencionDental;
        $this->programaEspecial = $programaEspecial;
        $this->fechaInicioProgramaEspecial = $fechaInicioProgramaEspecial;
        $this->parentescoPetro = $parentescoPetro;
        $this->basico = $basico;
        $this->onco = $onco;
        $this->segundaCapa = $segundaCapa;
        $this->fallecido = $fallecido;
        $this->contratante = $contratante;

        $this->dependencia = $dependencia;
        $this->rol = $rol;
        $this->idHijo = $idHijo;
        $this->documento = $documento;
        $this->afiliado = $afiliado;
    }

    public function afiliadoId(): AffiliateDetailAfiliadoId
    {
        return $this->afiliadoId;
    }
    public function programaAtencionDental(): AffiliateDetailProgramaAtencionDental
    {
        return $this->programaAtencionDental;
    }
    public function programaEspecial(): AffiliateDetailProgramaEspecial
    {
        return $this->programaEspecial;
    }
    public function fechaInicioProgramaEspecial(): AffiliateDetailFechaInicioProgramaEspecial
    {
        return $this->fechaInicioProgramaEspecial;
    }
    public function parentescoPetro(): AffiliateDetailParentescoPetro
    {
        return $this->parentescoPetro;
    }
    public function basico(): AffiliateDetailBasico
    {
        return $this->basico;
    }
    public function onco(): AffiliateDetailOnco
    {
        return $this->onco;
    }
    public function segundaCapa(): AffiliateDetailSegundaCapa
    {
        return $this->segundaCapa;
    }
    public function fallecido(): AffiliateDetailFallecido
    {
        return $this->fallecido;
    }
    public function contratante(): AffiliateDetailContratante
    {
        return $this->contratante;
    }

    
    public function dependencia(): AffiliateDetailDependencia
    {
        return $this->dependencia;
    }

    public function rol(): AffiliateDetailRol
    {
        return $this->rol;
    }

    public function idHijo(): AffiliateDetailIdHijo
    {
        return $this->idHijo;
    }

    public function documento(): AffiliateDetailDocumento
    {
        return $this->documento;
    }

    public function afiliado(): AffiliateDetailAfiliado
    {
        return $this->afiliado;
    }


    /** Proceso create Eloquent*/
    public static function create(
        AffiliateDetailAfiliadoId $afiliadoId,
        AffiliateDetailProgramaAtencionDental $programaAtencionDental,
        AffiliateDetailProgramaEspecial $programaEspecial,
        AffiliateDetailFechaInicioProgramaEspecial $fechaInicioProgramaEspecial,
        AffiliateDetailParentescoPetro $parentescoPetro,
        AffiliateDetailBasico $basico,
        AffiliateDetailOnco $onco,
        AffiliateDetailSegundaCapa $segundaCapa,
        AffiliateDetailFallecido $fallecido,
        AffiliateDetailContratante $contratante,

        AffiliateDetailDependencia $dependencia,
        AffiliateDetailRol $rol,
        AffiliateDetailIdHijo $idHijo,
        AffiliateDetailDocumento $documento,
        AffiliateDetailAfiliado $afiliado,

    ): AffiliateDetail {
        $afiDet = new self(
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

        return $afiDet;
    }
}

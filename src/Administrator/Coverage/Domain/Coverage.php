<?php

declare(strict_types=1);

namespace Src\Administrator\Coverage\Domain;

use Src\Administrator\Coverage\Domain\ValueObjects\CoverageCodigo;
use Src\Administrator\Coverage\Domain\ValueObjects\CoverageCodigoante;
use Src\Administrator\Coverage\Domain\ValueObjects\CoverageCodigoSeps;
use Src\Administrator\Coverage\Domain\ValueObjects\CoverageCodigoSubt;
use Src\Administrator\Coverage\Domain\ValueObjects\CoverageCodigoTipo;
use Src\Administrator\Coverage\Domain\ValueObjects\CoverageDescripcion;
use Src\Administrator\Coverage\Domain\ValueObjects\CoverageDescripcionSuSalud;
use Src\Administrator\Coverage\Domain\ValueObjects\CoverageTipo;

final class Coverage
{
    private $codigo;
    private $descripcion;
    private $codigoante;
    private $codigotipo;
    private $codigosubt;
    private $tipo;
    private $descripcionsusalud;
    private $codigoseps;

    /**
     * @return CoverageCodigo
     */
    public function getCodigo(): CoverageCodigo
    {
        return $this->codigo;
    }

    /**
     * @return CoverageDescripcion
     */
    public function getDescripcion(): CoverageDescripcion
    {
        return $this->descripcion;
    }

    /**
     * @return CoverageCodigoante
     */
    public function getCodigoante(): CoverageCodigoante
    {
        return $this->codigoante;
    }

    /**
     * @return CoverageCodigoTipo
     */
    public function getCodigotipo(): CoverageCodigoTipo
    {
        return $this->codigotipo;
    }

    /**
     * @return CoverageCodigoSubt
     */
    public function getCodigosubt(): CoverageCodigoSubt
    {
        return $this->codigosubt;
    }

    /**
     * @return CoverageTipo
     */
    public function getTipo(): CoverageTipo
    {
        return $this->tipo;
    }

    /**
     * @return CoverageDescripcionSuSalud
     */
    public function getDescripcionsusalud(): CoverageDescripcionSuSalud
    {
        return $this->descripcionsusalud;
    }

    /**
     * @return CoverageCodigoSeps
     */
    public function getCodigoseps(): CoverageCodigoSeps
    {
        return $this->codigoseps;
    }

    /**
     * @param $codigo
     * @param $descripcion
     * @param $codigoante
     * @param $codigotipo
     * @param $codigosubt
     * @param $tipo
     * @param $descripcionsusalud
     * @param $codigoseps
     */
    public function __construct(
        CoverageCodigo $codigo,
        CoverageDescripcion $descripcion,
        CoverageCodigoante $codigoante,
        CoverageCodigoTipo $codigotipo,
        CoverageCodigoSubt $codigosubt,
        CoverageTipo $tipo,
        CoverageDescripcionSuSalud $descripcionsusalud,
        CoverageCodigoSeps $codigoseps
    ) {
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->codigoante = $codigoante;
        $this->codigotipo = $codigotipo;
        $this->codigosubt = $codigosubt;
        $this->tipo = $tipo;
        $this->descripcionsusalud = $descripcionsusalud;
        $this->codigoseps = $codigoseps;
    }

    public static function create(
        CoverageCodigo $codigo,
        CoverageDescripcion $descripcion,
        CoverageCodigoante $codigoante,
        CoverageCodigoTipo $codigotipo,
        CoverageCodigoSubt $codigosubt,
        CoverageTipo $tipo,
        CoverageDescripcionSuSalud $descripcionsusalud,
        CoverageCodigoSeps $codigoseps
    ): Coverage {
        return new self(
            $codigo,
            $descripcion,
            $codigoante,
            $codigotipo,
            $codigosubt,
            $tipo,
            $descripcionsusalud,
            $codigoseps
        );
    }
}

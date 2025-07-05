<?php

namespace Src\Administrator\AffiliateNotification\Infrastructure;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Src\Administrator\Affiliate\Application\Get\GetAffiliateByCode;
use Src\Administrator\Affiliate\Infrastructure\Persistence\Eloquent\EloquentAffiliateRepository;
use Src\Administrator\AffiliateNotification\Application\Create\AffiliateNotificationCreator;
use Src\Administrator\AffiliateNotification\Application\Get\GetAffiliateNotificationByIdSis;
use Src\Administrator\AffiliateNotification\Application\Update\AffiliateNotificationUpdater;
use Src\Administrator\AffiliateNotification\Infrastructure\Persistence\EloquentAffiliateNotificationRepository;

final class UpdateAffiliateNotificationController
{
    private $repository;
    private $affiliateRepository;

    public function __construct(EloquentAffiliateNotificationRepository $repository, EloquentAffiliateRepository $affiliateRepository)
    {
        $this->repository = $repository;
        $this->affiliateRepository = $affiliateRepository;
    }

    public function __invoke(int $idSis, Request $request)
    {
        $codigoAfiliado = $this->formatCodigoAfiliado($request->input('codigoAfiliado'));
        $descripcion = $request->input('descripcion');
        $clasificacionId = $request->input('clasificacionId');
        $fechaDesde = $request->input('fechaDesde');
        $fechaHasta = $request->input('fechaHasta');
        $sinLimite = $request->input('sinLimite');
        $estado = $request->input('estado');

        $getAffiliateNot = new GetAffiliateNotificationByIdSis($this->repository);
        $affiliateNot = $getAffiliateNot->__invoke($idSis);
        if (!$affiliateNot) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'afiliado aviso idSis no existe',
                        'errors' => [
                            'idSis' => ['afiliado aviso idSis: ' . $idSis . ' no existe']
                        ]
                    ],
                    403
                )
            );
        }

        $getAffiliate = new GetAffiliateByCode($this->affiliateRepository);
        $affiliate = $getAffiliate->__invoke($codigoAfiliado);

        if (!$affiliate) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Codigo afiliado no existe',
                        'errors' => [
                            'codigoAfiliado' => ['Codigo afiliado: ' . $codigoAfiliado . ' no existe']
                        ]
                    ],
                    403
                )
            );
        }

        $newPlan = new AffiliateNotificationUpdater($this->repository);
        $planR = $newPlan->__invoke(
            $idSis,
            $affiliate,
            $descripcion,
            $clasificacionId,
            $sinLimite,
            $estado,
            $fechaDesde,
            $fechaHasta
        );

        return [
            'status' => true,
            'message' => 'aviso afiliado actualizado con Id: ' . $planR->value(),
            'id' => $planR->value(),
        ];
    }


    public function formatCodigoAfiliado ($cod_afiliado) {
        if ($cod_afiliado != null && strlen($cod_afiliado) == 10) {
            return substr($cod_afiliado,0,2)."-".substr($cod_afiliado,2,6)."-".substr($cod_afiliado,8,2);
        }
    }

}

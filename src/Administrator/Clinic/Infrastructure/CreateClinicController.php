<?php

declare(strict_types=1);

namespace Src\Administrator\Clinic\Infrastructure;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Clinic;
use Src\Administrator\Clinic\Application\Get\GetClinicByCode;
use Src\Administrator\Ubigeo\Application\Get\GetUbigeoByCode;
use Src\Administrator\Ubigeo\Infrastructure\Persistence\Eloquent\EloquentUbigeoRepository;
use Src\Administrator\Clinic\Infrastructure\Persistence\Eloquent\EloquentClinicRepository;

use Src\Administrator\Clinic\Application\Create\ClinicCreator;
use Src\Administrator\MedicalNetwork\Application\Get\GetMedicalNetwork;
use Src\Administrator\MedicalNetwork\Infrastructure\Persistence\Eloquent\EloquentMedicalNetworkRepository;
use Src\Administrator\Ubigeo\Application\Get\GetUbigeo;

final class CreateClinicController
{
    private $repository;
    private $repositoryUbigeo;
    private $repositoryMedNetw;

    public function __construct(EloquentClinicRepository $repository)
    {
        $this->repository = $repository;
        $this->repositoryUbigeo = new EloquentUbigeoRepository;
        $this->repositoryMedNetw = new EloquentMedicalNetworkRepository;
    }

    public function __invoke(Request $request)
    {

        $codigo = $request->input('codigo');
        $codigoUbigeo = $request->input('codigoUbigeo');
        $nombre = $request->input('nombre');
        $ruc = $request->input('ruc');
        $telefono = $request->input('telefono');
        $email = $request->input('email');
        $direccion = $request->input('direccion');
        $tipo = $request->input('tipo');
        $acceso = $request->input('acceso');
        $entVinculada = $request->input('entVinculada');
        $ipress = $request->input('ipress');
        $renipress = $request->input('renipress');
        $estado = $request->input('estado');
        $zona = $request->input('zona');
        $igv = $request->input('igv');
        $sede = $request->input('sede');
        $ubicacion = $request->input('ubicacion');


        $telefono = $telefono ? $telefono : null;
        $email = $email ? $email : null;
        $direccion = $direccion ? $direccion : null;
        $entVinculada = $entVinculada ? $entVinculada : null;
        $ipress = $ipress ? $ipress : null;
        $renipress = $renipress ? $renipress : null;
        $zona = $zona ? $zona : null;



        $getClinic = new GetClinicByCode($this->repository);
        $clinic = $getClinic->__invoke($codigo);

        /* if ($clinic) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Clinica Codigo ya existe',
                        'errors' => [
                            'codigo' => ['Clinica codigo: ' . $codigo . ' ya existe']
                        ]
                    ],
                    403
                )
            );
        }*/

        /** Proceso validación de Id Red Medica */
        $getUbi = new GetUbigeoByCode($this->repositoryUbigeo);
        // echo "ubigeoId:" . $ubigeoId;
        $ubigeoId = $getUbi->__invoke($codigoUbigeo);
        if (!$ubigeoId) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Ubigeo Codigo no existe',
                        'errors' => [
                            'codigoUbigeo' => ['Ubigeo codigo: ' . $codigoUbigeo . ' No existe']
                        ]
                    ],
                    403
                )
            );
        }

        $user = Auth::user();
        // echo "user" . $user->id;
        $usuarioId = $user->id;

        /* $newClinc = new ClinicCreator($this->repository);
        $cliniR = $newClinc->__invoke(
            $usuarioId,
            $codigo,
            null,
            $ubigeoId->value(),
            $nombre,
            $ruc,
            $telefono,
            $email,
            $direccion,
            $tipo,
            $acceso,
            $entVinculada,
            $ipress,
            $renipress,
            $estado,
            $zona,
            $igv,
            $sede,
            $ubicacion,
        );*/



        $idClinica = Clinic::where('codigo', '=', $codigo)->exists();

        if (!$idClinica) {
            //  dd("null?");

            Clinic::create([
                'codigo'                =>   $codigo,
             //   'usuario_id'            =>   $usuarioId,
                'ubigeo_id'             =>   $ubigeoId,
                'nombre'                =>   $nombre,
                'ruc'                   =>   $ruc,
                'telefono'              =>   $telefono,
                'email'                 =>   $email,
                'direccion'             =>   $direccion,
                'zona'                  =>   $zona,
                'sede'                  =>   $sede,
                'ubicacion'             =>   $ubicacion,
                'tipo_clinica_id'       =>   $tipo,
                'ipress'                =>   $ipress,
                'renipress'             =>   $renipress,
                'igv'                   =>   $igv,
                'estado'                =>   $estado,

            ]);

            return [
                'status' => true,
                'message' => 'Clínica creado.'
            ];
        } else {
            Clinic::where('codigo', '=', $codigo)->update([
               // 'usuario_id'         =>   $usuarioId,
                'ubigeo_id'          =>   $ubigeoId,
                'nombre'             =>   $nombre,
                'ruc'                =>   $ruc,
                'telefono'           =>   $telefono,
                'email'              =>   $email,
                'direccion'          =>   $direccion,
                'zona'               =>   $zona,
                'sede'               =>   $sede,
                'ubicacion'          =>   $ubicacion,
                'tipo_clinica_id'    =>   $tipo,
                'ipress'             =>   $ipress,
                'renipress'          =>   $renipress,
                'igv'                =>   $igv,
                'estado'             =>   $estado,

            ]);


            return [
                'status' => true,
                'message' => 'Clínica Actualizado.'
            ];
        }
    }
}

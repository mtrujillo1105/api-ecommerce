<?php

declare(strict_types=1);

namespace Src\Administrator\PersonAffiliateAndDetails\Infrastructure;

use App\Models\Category;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Src\Administrator\Affiliate\Application\Create\AffiliateCreator;
use Src\Administrator\Affiliate\Application\Get\GetAffiliateByContract;
use Src\Administrator\Affiliate\Application\Get\GetAffiliateByContractAndDocument;
use Src\Administrator\Affiliate\Infrastructure\Persistence\Eloquent\EloquentAffiliateRepository;
use Src\Administrator\AffiliateDetail\Application\Create\AffiliateDetailCreator;
use Src\Administrator\AffiliateDetail\Infrastructure\Persistence\Eloquent\EloquentAffiliateDetailRepository;
use Src\Administrator\Category\Application\Get\GetCategoryByCode;
use Src\Administrator\Category\Infrastructure\Persistence\Eloquent\EloquentCategoryRepository;
use Src\Administrator\Customer\Application\Get\GetCustomerByCode;
use Src\Administrator\Department\Application\Get\GetDepartmentByCode;
use Src\Administrator\District\Application\Get\GetDistrictByCode;
use App\Models\Person;
use App\Models\PersonDetail;
use App\Models\Affiliate;
use App\Models\Nationality;
use App\Models\AffiliateDetail;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Src\Administrator\DocumentType\Infrastructure\Persistence\Eloquent\EloquentDocumentTypeRepository;
use Src\Administrator\PersonType\Infrastructure\Persistence\Eloquent\EloquentPersonTypeRepository;
use Src\Administrator\CivilStatus\Infrastructure\Persistence\Eloquent\EloquentCivilStatusRepository;
use Src\Administrator\Person\Infrastructure\Persistence\Eloquent\EloquentPersonRepository;
use Src\Administrator\Customer\Infrastructure\Persistence\Eloquent\EloquentCustomerRepository;
use Src\Administrator\Department\Infrastructure\Persistence\Eloquent\EloquentDepartmentRepository;
use Src\Administrator\District\Infrastructure\Persistence\Eloquent\EloquentDistrictRepository;
use Src\Administrator\LowReason\Infrastructure\Persistence\Eloquent\EloquentLowReasonRepository;
use Src\Administrator\Nationality\Infrastructure\Persistence\Eloquent\EloquentNationalityRepository;
use Src\Administrator\Plan\Application\Get\GetPlanByIdEquivSis;
use Src\Administrator\Plan\Infrastructure\Persistence\Eloquent\EloquentPlanRepository;
use Src\Administrator\Province\Application\Get\GetProvinceByCode;
use Src\Administrator\Province\Infrastructure\Persistence\Eloquent\EloquentProvinceRepository;
use Src\Administrator\PersonDetail\Infrastructure\Persistence\Eloquent\EloquentPersonDetailRepository;

use Src\Administrator\DocumentType\Application\Get\GetDocumentType;
use Src\Administrator\PersonType\Application\Get\GetPersonType;
use Src\Administrator\CivilStatus\Application\Get\GetCivilStatus;
use Src\Administrator\Customer\Application\Get\GetCustomer;
use Src\Administrator\District\Application\Get\GetDistrict;
use Src\Administrator\LowReason\Application\Get\GetLowReason;
use Src\Administrator\Nationality\Application\Get\GetNationality;
use Src\Administrator\Person\Application\Create\PersonCreator;
use Src\Administrator\PersonDetail\Application\Create\PersonDetailCreator;
use Src\Administrator\Plan\Application\Get\GetPlan;

final class CreatePersonAffiliateAndDetailsController
{
    private $repositoryPerson;
    private $repositoryPerDet;
    private $repositoryDocType;
    private $repositoryPerType;
    private $repositoryCivilSt;

    private $repositoryDepart;
    private $repositoryProvin;
    private $repositoryDistri;
    private $repositoryNacion;

    private $repositoryClient;
    private $repositoryCatego;
    private $repositoryPlan;
    private $repositoryMotBaj;

    private $repositoryAfili;
    private $repositoryAfDet;


    // public function __construct(EloquentPersonRepository $repository)
    public function __construct()
    {
        // $this->repository = $repository;
        $this->repositoryPerson = new EloquentPersonRepository;
        $this->repositoryPerDet = new EloquentPersonDetailRepository;
        $this->repositoryDocType = new EloquentDocumentTypeRepository;
        $this->repositoryPerType = new EloquentPersonTypeRepository;
        $this->repositoryCivilSt = new EloquentCivilStatusRepository;

        $this->repositoryDepart = new EloquentDepartmentRepository;
        $this->repositoryProvin = new EloquentProvinceRepository;
        $this->repositoryDistri = new EloquentDistrictRepository;
        $this->repositoryNacion = new EloquentNationalityRepository;

        $this->repositoryClient = new EloquentCustomerRepository;
        $this->repositoryCatego = new EloquentCategoryRepository;
        $this->repositoryPlan = new EloquentPlanRepository;
        $this->repositoryMotBaj = new EloquentLowReasonRepository;

        $this->repositoryAfili = new EloquentAffiliateRepository;
        $this->repositoryAfDet = new EloquentAffiliateDetailRepository;
    }

    public function __invoke(Request $request)
    {
        /** Datos de Persona */

        Log::info('crear_persona_data', [
            'data_request' => $request->all()
        ]);

        $apePaterno = $request->input('apePaterno');
        $apeMaterno = $request->input('apeMaterno');
        $nombre = $request->input('nombre');
        $razonSocial = $request->input('razonSocial');

        $tipoPersonaId = $request->input('tipoPersonaId');
        $tipoDocumentoId = $request->input('tipoDocumentoId');
        $estadoCivilId = $request->input('estadoCivilId');
        $nroDocumento = $request->input('nroDocumento');
        $fechaNacimiento = $request->input('fechaNacimiento');
        $sexo = $request->input('sexo');
        //username y password,
        $username = $request->input('username');
        $password = $request->input('password');


        // echo "apePaterno->" . $apePaterno;
        $apePaterno = $apePaterno ? $apePaterno : null;
        // echo "apePaterno2->" . $apePaterno;
        $apeMaterno = $apeMaterno ? $apeMaterno : null;
        $nombre = $nombre ? $nombre : null;
        $razonSocial = $razonSocial ? $razonSocial : null;

        $tipoPersonaId = (int) $tipoPersonaId;
        $tipoDocumentoId = (int) $tipoDocumentoId;
        $estadoCivilId = (int) $estadoCivilId;

        /** Datos de Persona Detalle */

        $departamentoCode = $request->input('codigoDepartamento');
        $provinciaCode = $request->input('codigoProvincia');
        $distritoCode = $request->input('codigoDistrito');
        $nacionalidadId = (int) $request->input('nacionalidadId');
        $direccion = $request->input('direccion');
        $email = $request->input('email');
        $telefono = $request->input('telefono');
        $foto = $request->input('foto');
        $peso = $request->input('peso');
        $estatura = $request->input('estatura');
        $discapacitado = $request->input('discapacitado');
        $consumeAlcohol = $request->input('consumeAlcohol');
        $consumeDrogas = $request->input('consumeDrogas');
        $grupoSanguineo = $request->input('grupoSanguineo');

        $rol = $request->input('rol');
        $dependencia = $request->input('dependencia');
        $asignacion_concubina = $request->input('asignacion_concubina');
       
        $direccion = $direccion ? $direccion : null;
        $email = $email ? $email : null;
        $telefono = $telefono ? $telefono : null;
        $foto = $foto ? $foto : null;

        $peso = $peso ? (float) $peso : null;
        $estatura = $estatura ? (float) $estatura : null;

        $rol = $rol ? $rol : null;
        $dependencia = $dependencia ? $dependencia : null;
        $asignacion_concubina = $asignacion_concubina ? $asignacion_concubina : false;


        /* $discapacitado = $discapacitado ? $discapacitado : null;
        $consumeAlcohol = $consumeAlcohol ? $consumeAlcohol : null;
        $consumeDrogas = $consumeDrogas ? $consumeDrogas : null;
        $grupoSanguineo = $grupoSanguineo ? $grupoSanguineo : null;
        */

        /** Datos de Afiliado */

        $codigoCliente = $request->input('codigoCliente');
        $codigoCategoria = $request->input('codigoCategoria');
        $planId = (int) $request->input('planId');
        $motivoBajaId = (int) $request->input('motivoBajaId');

        //$afiliadoTitularId = (int) $request->input('afiliadoTitularId');
        $codTitula = $request->input('codTitula');
        $centroCosto = $request->input('centroCosto');
        $fechaAlta = $request->input('fechaAlta');
        $fechaBaja = $request->input('fechaBaja');
        $fechaFinCarencia = $request->input('fechaFinCarencia');
        $fechaContinuidad = $request->input('fechaContinuidad');
        $financia = $request->input('financia');
        $contrato = $request->input('contrato');

        $codAfiliado = $this->formatCodigoAfiliado($request->input('codAfiliado'));
        $estado = (int) $request->input('estado');
        //hoola
        $fechaBaja = $fechaBaja ? $fechaBaja : null;
        $fechaFinCarencia = $fechaFinCarencia ? $fechaFinCarencia : null;
        $fechaContinuidad = $fechaContinuidad ? $fechaContinuidad : null;

        /** Datos de Afiliado Detalle */

        $programaAtencionDental = $request->input('programaAtencionDental');
        $programaEspecial = $request->input('programaEspecial');
        $fechaInicioProgramaEspecial = $request->input('fechaInicioProgramaEspecial');
        $parentescoPetro = $request->input('parentescoPetro');
        $basico = $request->input('basico');
        $onco = $request->input('onco');
        $segundaCapa = $request->input('segundaCapa');
        $fallecido = (int) $request->input('fallecido');
        $contratante = (int) $request->input('contratante');

        $fechaInicioProgramaEspecial = $fechaInicioProgramaEspecial ? $fechaInicioProgramaEspecial : null;
        $parentescoPetro = $parentescoPetro ? $parentescoPetro : null;

        $dependencia = $request->input('dependencia');
        $rol = $request->input('rol');
        $idHijo = $request->input('idHijo');
        $documento = $request->input('documento');
        $afiliado =  $request->input('afiliado');
        $recien_nacido   = $request->input('recien_nacido'); 

        $id_core_sis_afiliado   = $request->input('id_core_sis_afiliado'); 
        $id_core_sis_persona   = $request->input('id_core_sis_persona'); 
    

        //dd($codAfiliado);
        /**
         *
         * Proceso validación necesaria para
         * la creacion de entidad Persona
         *
         */
             // validate de Id Document Type
             $getDocType = new GetDocumentType($this->repositoryDocType);
             $docType = $getDocType->__invoke($tipoDocumentoId);

             //dd($docType);
             if ($docType === null) {
                 throw new HttpResponseException(
                     response()->json(
                         [
                             'status' => false,
                             'message' => 'Tipo Documento Id no existe',
                             'errors' => [
                                 'tipoDocumentoId' => ['Tipo Documento Id: ' . $tipoDocumentoId . ' No existe']
                             ]
                         ],
                         403
                     )
                 );
             }
             $dept = "15";
             $provinc = "128";
             $district = "1249";
        //dd(["datos"=>[$provinciaCode,$provinciaCode,$distritoCode]]);
        if(  !is_null($departamentoCode) AND
             !is_null($provinciaCode) AND
             !is_null($distritoCode) AND  $departamentoCode != "0" AND  $provinciaCode   != "0"   AND     $distritoCode != "0" ){
       
                 // validate de Id Departamento
                            $getDept = new GetDepartmentByCode($this->repositoryDepart);

                            $dept = $getDept->__invoke($departamentoCode);
                            if ($dept === null) {
                                throw new HttpResponseException(
                                    response()->json(
                                        [
                                            'status' => false,
                                            'message' => 'Departamento Id no existe',
                                            'errors' => [
                                                'departamentoId' => ['Departamento Codigo: ' . $departamentoCode . ' no existe']
                                            ]
                                        ],
                                        403
                                    )
                                );
                            }

                            // validate de Id Provincia
                            $getProv = new GetProvinceByCode($this->repositoryProvin);

                            $provinc = $getProv->__invoke($provinciaCode);
                            if ($provinc === null) {
                                throw new HttpResponseException(
                                    response()->json(
                                        [
                                            'status' => false,
                                            'message' => 'Provincia Id no existe',
                                            'errors' => [
                                                'provinciaId' => ['Provincia Code: ' . $provinciaCode . ' no existe']
                                            ]
                                        ],
                                        403
                                    )
                                );
                            }

                            // validate de Id Distrito
                            $getDist = new GetDistrictByCode($this->repositoryDistri);

                            $district = $getDist->__invoke($distritoCode);
                            if ($district === null) {
                                throw new HttpResponseException(
                                    response()->json(
                                        [
                                            'status' => false,
                                            'message' => 'Distrito Id no existe',
                                            'errors' => [
                                                'distritoId' => ['Distrito Codigo: ' . $distritoCode . ' no existe']
                                            ]
                                        ],
                                        403
                                    )
                                );
                            }                      


        }

        $getPersonType = new GetPersonType($this->repositoryPerType);

        $perType = $getPersonType->__invoke($tipoPersonaId);
        if ($perType === null) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Tipo Persona Id no existe',
                        'errors' => [
                            'tipoPersonId' => ['Tipo Persona Id: ' . $tipoPersonaId . ' No existe']
                        ]
                    ],
                    403
                )
            );
        }
       

        // validate de Id Civil Status
        $getCivilSt = new GetCivilStatus($this->repositoryCivilSt);

        $civilSt = $getCivilSt->__invoke($estadoCivilId);
        if ($civilSt === null) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Estado Civil Id no existe',
                        'errors' => [
                            'estadoCivilId' => ['Estado Civil Id: ' . $estadoCivilId . ' no existe']
                        ]
                    ],
                    403
                )
            );
        }

        /**
         *
         * Proceso de validacion necesaria para
         * la creacion del detalle Persona
         *
         */

        

        // validate de Id nacionalidad
        /* $getNacion = new GetNationality($this->repositoryNacion);

        $nacionld = $getNacion->__invoke($nacionalidadId);*/
        $nacionld   = Nationality::where('id', '=', $nacionalidadId)->pluck('id')->first();
        if ($nacionld === null) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Nacionalidad Id no existe',
                        'errors' => [
                            'nacionalidadId' => ['Nacionalidad Id: ' . $nacionalidadId . ' no existe']
                        ]
                    ],
                    403
                )
            );
        }

        /**
         *
         * Proceso de Validacion necesaria para
         * la creacion del Afiliado
         *
         */

        // validate de Id cliente
        $getCust = new GetCustomerByCode($this->repositoryClient);

        $cliId = $getCust->__invoke($codigoCliente);
        
        if ($cliId === null) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Cliente Id no existe',
                        'errors' => [
                            'clienteId' => ['Cliente Codigo: ' . $codigoCliente . ' no existe']
                        ]
                    ],
                    403
                )
            );
        }

        // validate de Id Categoria
        $getCate = new GetCategoryByCode($this->repositoryCatego);

        $catId = $getCate->__invoke($codigoCategoria);
        if ($catId === null) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Categoria Codigo no existe',
                        'errors' => [
                            'categoriaId' => ['Categoria codigo: ' . $codigoCategoria . ' no existe']
                        ]
                    ],
                    403
                )
            );
        }

        // validate de Id Plan
        //dd($this->repositoryPlan);
        $getPlan = new GetPlanByIdEquivSis($this->repositoryPlan, $cliId);
        
        $planIdr = $getPlan->__invoke($planId);
       // dd($planIdr );
        if ($planIdr === null) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Plan IdSis no existe',
                        'errors' => [
                            'planId' => ['Plan IdSis: ' . $planId . '-' . $cliId . ' no existe']
                        ]
                    ],
                    403
                )
            );
        }

        // validate de Id Motivo Baja
        $getMoRe = new GetLowReason($this->repositoryMotBaj);

        $motBId = $getMoRe->__invoke($motivoBajaId);
        if ($motBId === null) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => 'Motivo Baja Id no existe',
                        'errors' => [
                            'motivoBajaId' => ['Motivo Baja Id: ' . $motivoBajaId . ' no existe']
                        ]
                    ],
                    403
                )
            );
        }


        $IdAffiliate = Affiliate::where('id_core_sis', '=', $id_core_sis_afiliado)->first();

        if ($IdAffiliate) {
            $IdAffiliate = $IdAffiliate->id;
        } else {
            // No se encontró ningún registro
            $IdAffiliate = null;
        }


        $IdPersona  =  Person::where('id_core_sis', '=', $id_core_sis_persona)
                             //->where('tipo_documento_id', '=', $tipoDocumentoId)
                             ->pluck('id')->toArray();

        //dd($IdPersona );
        if ($IdPersona) {
            $IdPersona = $IdPersona->id;
        } else {
            // No se encontró ningún registro
            $IdPersona  = null;
        }


        if ($IdPersona == null) {
            $existePersona = false;
        } else {
            $existePersona = true;
        }

        if ($IdAffiliate == null) {
            $existeAfiliado = false;
        } else {
            $existeAfiliado = true;
        }


        if ($existePersona) {
            //ACtualiza perosna
     
            $dataToUpdate = [
                'ape_paterno'         => $apePaterno,
                'nombre'              => $nombre,
                'razon_social'        => $razonSocial,
                'tipo_persona_id'     => $tipoPersonaId,
                'fecha_nacimiento'    => $fechaNacimiento,
                'sexo'                => $sexo,
                'estado_civil_id'     => $estadoCivilId
            ];
                
            // Añade 'ape_materno' al arreglo solo si es nulo
            if (!is_null($apeMaterno)) {
                $dataToUpdate['ape_materno'] = $apeMaterno;
            }
            
            $person = Person::whereIn('id', $IdPersona)
                ->update($dataToUpdate);    


            $IdPersona = is_array($IdPersona) ? $IdPersona : [$IdPersona];


            $person = PersonDetail::whereIn('persona_id', $IdPersona)
                ->update([
                    'departamento_id'     =>   $dept,
                    'provincia_id'        =>   $provinc,
                    'distrito_id'         =>   $district,
                    'nacionalidad_id'     =>   1,
                    'direccion'           =>   $direccion,
                    'email'               =>   $email,
                    'telefono'            =>   $telefono,
                    'foto'                =>   $foto,
                    'peso'                =>   $peso,
                    'estatura'            =>   $estatura,
                    'discapacitado'       =>   $discapacitado,
                    'consume_alcohol'     =>   $consumeAlcohol,
                    'consume_drogas'      =>   $consumeDrogas,
                    'grupo_sanguineo'     =>   $grupoSanguineo
                ]);
        } else {
        
            $dataToCreate = [
                'ape_paterno'         => $apePaterno,
                'nombre'              => $nombre,
                'razon_social'        => $razonSocial,
                'tipo_persona_id'     => $tipoPersonaId,
                'tipo_documento_id'   => $tipoDocumentoId,
                'nro_documento'       => $nroDocumento,
                'fecha_nacimiento'    => $fechaNacimiento,
                'sexo'                => $sexo,
                'estado_civil_id'     => $estadoCivilId,
                'id_core_sis'         => $id_core_sis_persona,
            ];
            
            // Añade 'ape_materno' al arreglo solo si es nulo
            if (!is_null($apeMaterno)) {
                $dataToCreate['ape_materno'] = $apeMaterno;
            }
            
            $person = Person::create($dataToCreate);

            $IdPersona = $person->id;

            $personDetail = PersonDetail::create([
                'persona_id'          =>   $IdPersona,
                'departamento_id'     =>   $dept,
                'provincia_id'        =>   $provinc,
                'distrito_id'         =>   $district,
                'nacionalidad_id'     =>   $nacionld,
                'direccion'           =>   $direccion,
                'email'               =>   $email,
                'telefono'            =>   $telefono,
                'foto'                =>   $foto,
                'peso'                =>   $peso,
                'estatura'            =>   $estatura,
                'discapacitado'       =>   $discapacitado,
                'consume_alcohol'     =>   $consumeAlcohol,
                'consume_drogas'      =>   $consumeDrogas,
                'grupo_sanguineo'     =>   $grupoSanguineo
            ]);
        }


        if ($existeAfiliado) {

            $update_data = [
                'plan_id'                => $planIdr,
                'cod_titula'             => $codTitula,
                'centro_costo'           => $centroCosto,
                'fecha_alta'             => $fechaAlta,
                'fecha_baja'             => $fechaBaja,
                'fecha_fin_carencia'     => $fechaFinCarencia,
                'fecha_continuidad'      => $fechaContinuidad,
                'financia'               => $financia,
                'contrato'               => $contrato,
                'cod_afiliado'           => $codAfiliado,
                
                'estado'                 => $estado,
                'recien_nacido'          => $recien_nacido

            ];

            if ($password) {
                $update_data =  array_merge([
                    'password'            => Hash::make($password),
                ], $update_data);
            }

            $affiliate = Affiliate::where('id', '=', $IdAffiliate)->update($update_data);
       
            AffiliateDetail::where('afiliado_id', '=', $IdAffiliate)->update([
                'programa_atencion_dental'          =>   $programaAtencionDental,
                'programa_especial'                 =>   $programaEspecial,
                'fecha_inicio_programa_especial'    =>   $fechaInicioProgramaEspecial,
                'parentesco_petro'                  =>   $parentescoPetro,
                'basico'                            =>   $basico,
                'onco'                              =>   $onco,
                'segunda_capa'                      =>   $segundaCapa,
                'fallecido'                         =>   $fallecido,
                'contratante'                       =>   $contratante,
                'rol'                               =>   $rol,
                'dependencia'                       =>   $dependencia,
                'asignacion_concubina'              =>   $asignacion_concubina,
                'parentesco_petro_hijos'            =>   $idHijo
            ]);

            return [
                'status'  => true,
                'message' => 'Actualizado'
            ];
        } else {

            $affiliate = Affiliate::create([
                'persona_id'             => $IdPersona,
                'cliente_id'             => $cliId,
                'categoria_id'           => $catId,
                'plan_id'                => $planIdr,
                'cod_titula'             => $codTitula,
                'centro_costo'           => $centroCosto,
                'fecha_alta'             => $fechaAlta,
                'fecha_baja'             => $fechaBaja,
                'fecha_fin_carencia'     => $fechaFinCarencia,
                'fecha_continuidad'      => $fechaContinuidad,
                'financia'               => $financia,
                'contrato'               => $contrato,
                'cod_afiliado'           => $codAfiliado,
                'username'               => $username,
                'password'               => Hash::make($password),
                'estado'                 => $estado,
                'recien_nacido'          => $recien_nacido,
                'id_core_sis'            => $id_core_sis_persona,
            ]);

            $IdAfiliado = $affiliate->id;


            $affiliateTitularIdDoc =  Affiliate::where([
                'contrato'     => $contrato,
                'categoria_id' => 1,
                'cliente_id'   => $cliId
            ])->first();


            $affiliateTitularId = $affiliateTitularIdDoc ?  $affiliateTitularIdDoc->id : $IdAfiliado;

            // dd($affiliateTitularId."ACHU".$IdAfiliado);    
            $affiliate = Affiliate::where('id', $IdAfiliado)->update([
                'afiliado_titular_id'    => $affiliateTitularId
            ]);

            $affiliateDetail = AffiliateDetail::create([
                'afiliado_id'                       =>   $IdAfiliado,
                'programa_atencion_dental'          =>   $programaAtencionDental,
                'programa_especial'                 =>   $programaEspecial,
                'fecha_inicio_programa_especial'    =>   $fechaInicioProgramaEspecial,
                'parentesco_petro'                  =>   $parentescoPetro,
                'basico'                            =>   $basico,
                'onco'                              =>   $onco,
                'segunda_capa'                      =>   $segundaCapa,
                'fallecido'                         =>   $fallecido,
                'contratante'                       =>   $contratante,
                'rol'                               =>   $rol,
                'dependencia'                       =>   $dependencia,
                'asignacion_concubina'              =>   $asignacion_concubina,
                'parentesco_petro_hijos'            =>   $idHijo
            ]);

            return [
                'status'  => true,
                'message' => 'Registrado'
            ];
        }
    }

    public function formatCodigoAfiliado ($cod_afiliado) {
        if ($cod_afiliado != null && strlen($cod_afiliado) == 10) {
            return substr($cod_afiliado,0,2)."-".substr($cod_afiliado,2,6)."-".substr($cod_afiliado,8,2);
        }
    }
}

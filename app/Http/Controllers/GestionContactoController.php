<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GestionContactoController extends Controller
{
    public function SetContactoPerNatural(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $cSegundoNombre      = ($request->cSegundoNombre == NULL) ? ($request->cSegundoNombre = ' ') : $request->cSegundoNombre;

        $arrayContacto = DB::select('exec [usp_Contacto_SetPerNaturalContacto] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [
                                                                $request->nIdTipoDocumento,
                                                                $request->cNumeroDocumento,
                                                                $request->cNombreCompleto,
                                                                $request->cPrimerNombre,
                                                                $cSegundoNombre,
                                                                $request->cApellidoPaterno,
                                                                $request->cApellidoMaterno,
                                                                $request->cUbigeo,
                                                                $request->cDepartamento,
                                                                $request->cProvincia,
                                                                $request->cDistrito,
                                                                $request->cDireccion,
                                                                $request->cEmail,
                                                                $request->cEmailAlternativo,
                                                                $request->dFechaNacimiento,
                                                                $request->nIdEstadoCivil,
                                                                $request->cTelefonoFijo,
                                                                $request->nTelefonoMovil,
                                                                $request->nTelefonoMovilAlternativo,
                                                                $request->cCentroLaboral,
                                                                $request->nIdProfesion,
                                                                Auth::user()->id
                                                            ]);

        return response()->json($arrayContacto);
    }

    public function SetContactoPerJuridica(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayContacto = DB::select('exec [usp_Contacto_SetPerJuridicaContacto] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $request->cRuc,
                                                                    $request->cRazonSocial,
                                                                    $request->cUbigeo,
                                                                    $request->cDepartamento,
                                                                    $request->cProvincia,
                                                                    $request->cDistrito,
                                                                    $request->cDireccion,
                                                                    $request->cEmail,
                                                                    $request->cEmailAlternativo,
                                                                    $request->cTelefonoFijo,
                                                                    $request->nTelefonoMovil,
                                                                    $request->nTelefonoMovilAlternativo,
                                                                    //Datos Contacto
                                                                    $request->nIdTipoDocumentoContacto,
                                                                    $request->cNumeroDocumentoContacto,
                                                                    $request->cNombreContacto,
                                                                    $request->cApellidoPaternoContacto,
                                                                    $request->cApellidoMaternoContacto,
                                                                    $request->cEmailPrincipalContacto,
                                                                    $request->cTelefonoMovilContacto,
                                                                    Auth::user()->id
                                                                ]);

        return response()->json($arrayContacto);
    }

    public function GetLineasByUsuario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     =   $request->nidempresa;
        $nIdProveedor   =   $request->nidproveedor;
        $nIdUsuario     =   Auth::user()->id;
        $variable       =   $request->opcion;

        $variable       =   ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayLinea = DB::select('exec [usp_Contacto_GetLineasByUsuario] ?, ?, ?',
                                            [   $nIdEmpresa,
                                                $nIdProveedor,
                                                $nIdUsuario
                                            ]);

        if($variable == "0"){
            $arrayLinea = ParametroController::arrayPaginator($arrayLinea, $request);
        }
        return ['arrayLinea'=>$arrayLinea];
    }

    public function GetMarcaByLinea(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdLinea   =   $request->nidlinea;
        $nIdUsuario =   Auth::user()->id;
        $variable   =   $request->opcion;

        $variable   =   ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayMarca =   DB::select('exec [usp_Contacto_GetMarcasByLinea] ?, ?',
                                            [   $nIdLinea,
                                                $nIdUsuario
                                            ]);

        if($variable == "0"){
            $arrayMarca = ParametroController::arrayPaginator($arrayMarca, $request);
        }
        return ['arrayMarca'=>$arrayMarca];
    }

    public function GetModeloByMarca(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdLinea   =   $request->nidlinea;
        $nIdMarca   =   $request->nidmarca;
        $nIdUsuario =   Auth::user()->id;
        $variable   =   $request->opcion;

        $nIdLinea   = ($nIdLinea == NULL) ? ($nIdLinea = 0) : $nIdLinea;
        $nIdMarca   = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $variable   = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayModelo = DB::select('exec [usp_Contacto_GetModelosByMarca] ?, ?, ?',
                                            [   $nIdLinea,
                                                $nIdMarca,
                                                $nIdUsuario
                                            ]);

        if($variable == "0"){
            $arrayModelo = ParametroController::arrayPaginator($arrayModelo, $request);
        }
        return ['arrayModelo'=>$arrayModelo];
    }

    public function SetContactoRefVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $referencia = $request->referencia;
            foreach($referencia as $ep=>$det) {
                DB::select('exec [usp_Contacto_SetReferenciaVehiculo] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $request->nIdEmpresa,
                                                                $request->nIdSucursal,
                                                                $request->nIdCronograma,
                                                                $request->nIdContacto,
                                                                $det['nIdProveedor'],
                                                                $det['nIdLinea'],
                                                                $det['nIdMarca'],
                                                                $det['nIdModelo'],
                                                                ($det['nAnioFabricacion'] == NULL) ? ($det['nAnioFabricacion'] = 0) : $det['nAnioFabricacion'],
                                                                $det['nAnioModelo'],
                                                                Auth::user()->id
                                                            ]);
            }

            $otrosintreses = $request->otrosintreses;
            $otrosintresesLength = sizeof($otrosintreses);
            if($otrosintresesLength > 0) {
                foreach($otrosintreses as $ep=>$det) {
                    DB::select('exec [usp_Contacto_SetReferenciaVehiculo] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdCronograma,
                                                                    $request->nIdContacto,
                                                                    $det['nIdProveedor'],
                                                                    $det['nIdLinea'],
                                                                    $det['nIdMarca'],
                                                                    $det['nIdModelo'],
                                                                    ($det['nAnioFabricacion'] == NULL) ? ($det['nAnioFabricacion'] = 0) : $det['nAnioFabricacion'],
                                                                    $det['nAnioModelo'],
                                                                    Auth::user()->id
                                                                ]);
                }
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetContactoSegRefVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayContacto = DB::select('exec [usp_Contacto_SetReferenciaVehiculo] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                        [   $request->nIdEmpresa,
                                                            $request->nIdSucursal,
                                                            $request->nIdCronograma,
                                                            $request->nIdContacto,
                                                            $request->nIdProveedor,
                                                            $request->nIdLinea,
                                                            $request->nIdMarca,
                                                            $request->nIdModelo,
                                                            $request->nAnioFabricacion,
                                                            $request->nAnioModelo,
                                                            Auth::user()->id
                                                        ]);
        return response()->json($arrayContacto);
    }

    public function GetListContactoBySinCarteraMes(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         = $request->nidempresa;
        $nIdSucursal        = $request->nidsucursal;
        $nIdCronograma      = $request->nidcronograma;
        $nTipoPersona       = $request->ntipopersona;
        $cNroDocumento      = $request->cnrodocumento;
        $cFiltroDescripcion = $request->cfiltrodescripcion;

        $cNroDocumento      = ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cFiltroDescripcion = ($cFiltroDescripcion == NULL) ? ($cFiltroDescripcion = ' ') : $cFiltroDescripcion;

        $arrayContacto = DB::select('exec [usp_Contacto_GetListContactoBySinCarteraMes] ?, ?, ?, ?, ?, ?, ?',
                                                                                [   $nIdEmpresa,
                                                                                    $nIdSucursal,
                                                                                    $nIdCronograma,
                                                                                    $nTipoPersona,
                                                                                    $cNroDocumento,
                                                                                    $cFiltroDescripcion,
                                                                                    Auth::user()->id
                                                                                ]);

        //$arrayContacto = ParametroController::arrayPaginator($arrayContacto, $request);
        return ['arrayContacto'=>$arrayContacto];
    }

    public function GetListContactoByRol(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         = $request->nidempresa;
        $nIdSucursal        = $request->nidsucursal;
        $nIdCronograma      = $request->nidcronograma;
        $nTipoPersona       = $request->ntipopersona;
        $cNroDocumento      = $request->cnrodocumento;
        $cContacto          = $request->cfiltrodescripcion;

        $cNroDocumento      = ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cContacto          = ($cContacto == NULL) ? ($cContacto = ' ') : $cContacto;

        $arrayContacto = DB::select('exec [usp_Contacto_GetListContactoByRol] ?, ?, ?, ?, ?, ?, ?',
                                                                                [   $nIdEmpresa,
                                                                                    $nIdSucursal,
                                                                                    $nIdCronograma,
                                                                                    $nTipoPersona,
                                                                                    $cNroDocumento,
                                                                                    $cContacto,
                                                                                    Auth::user()->id
                                                                                ]);

        //$arrayContacto = ParametroController::arrayPaginator($arrayContacto, $request);
        return ['arrayContacto'=>$arrayContacto];
    }

    public function SetContactoCarteraMesTodos(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayContacto = DB::select('exec [usp_Contacto_SetContactoCarteraMesTodos] ?, ?, ?, ?',
                                                            [   $request->nIdCronograma,
                                                                $request->nIdContacto,
                                                                $request->cFlagCarteraMes,
                                                                Auth::user()->id
                                                            ]);

        return response()->json($arrayContacto);
    }

    public function SetContactoCarteraMes(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayContacto = DB::select('exec [usp_Contacto_SetContactoCarteraMes] ?, ?, ?, ?, ?',
                                                            [   $request->nIdAsignacion,
                                                                $request->nIdCronograma,
                                                                $request->nIdContacto,
                                                                $request->cFlagCarteraMes,
                                                                Auth::user()->id
                                                            ]);

        return response()->json($arrayContacto);
    }

    public function GetCarteraMesByVendedor(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $nIdCronograma      =   $request->nidcronograma;
        $nTipoPersona       =   $request->ntipopersona;
        $cNroDocumento      =   $request->cnrodocumento;
        $cFiltroDescripcion =   $request->cfiltrodescripcion;

        $cNroDocumento      =   ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cFiltroDescripcion =   ($cFiltroDescripcion == NULL) ? ($cFiltroDescripcion = ' ') : $cFiltroDescripcion;

        $arrayContactoCarteraMes = DB::select('exec usp_Contacto_GetContactoCarteraMes ?, ?, ?, ?, ?, ?, ?',
                                                                        [   $nIdEmpresa,
                                                                            $nIdSucursal,
                                                                            $nIdCronograma,
                                                                            $nTipoPersona,
                                                                            $cNroDocumento,
                                                                            $cFiltroDescripcion,
                                                                            Auth::user()->id
                                                                        ]);

        //$arrayContactoCarteraMes = ParametroController::arrayPaginator($arrayContactoCarteraMes, $request);
        return ['arrayContactoCarteraMes'=>$arrayContactoCarteraMes];
    }

    public function GetContactoNaturalById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdContacto        =   $request->nidcontacto;
        $nIdPersonaNatural  =   $request->nidpersonanatural;

        $contacto = DB::select('exec usp_Contacto_GetContactoNaturalById ?, ?',
                                                                        array(  $nIdContacto,
                                                                                $nIdPersonaNatural
                                                                                ));

        return response()->json($contacto);
    }

    public function GetContactoJuridicoById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdContacto        =   $request->nidcontacto;
        $nIdPersonaJuridico =   $request->nidpersonajuridico;

        $contacto = DB::select('exec usp_Contacto_GetContactoJuridicoById ?, ?',
                                                                        array(  $nIdContacto,
                                                                                $nIdPersonaJuridico
                                                                                ));

        return response()->json($contacto);
    }

    public function GetRefVehiculoByContacto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     =   $request->nidempresa;
        $nIdSucursal    =   $request->nidsucursal;
        $nIdContacto    =   $request->nidcontacto;
        $nIdVendedor    =   $request->nidvendedor;

        $nIdVendedor = ($nIdVendedor == NULL) ? ($nIdVendedor = Auth::user()->id) : $nIdVendedor;

        $arraySegReferenciavehiculo = DB::select('exec [usp_Contacto_GetRefVehiculoByContacto] ?, ?, ?, ?',
                                                                        array(  $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $nIdContacto,
                                                                                $nIdVendedor
                                                                                ));

        $arraySegReferenciavehiculo = ParametroController::arrayPaginator($arraySegReferenciavehiculo, $request);
        return ['arraySegReferenciavehiculo'=>$arraySegReferenciavehiculo];
    }

    public function SetSeguimiento(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arraySeguimiento = DB::select('exec [usp_Contacto_SetSeguimiento] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            array(  $request->cFlagOrigenSeguimiento,
                                                                    $request->nIdAsignacionContactoVendedor,
                                                                    $request->nIdZona,
                                                                    $request->nIdTipoSeguimiento,
                                                                    $request->nIdFormaPago,
                                                                    $request->nIdEstadoSeguimiento,
                                                                    $request->dFechaSeguimientoVendedor,
                                                                    $request->cHoraSeguimiento,
                                                                    $request->cAsunto,
                                                                    $request->cRendirSeguimiento,
                                                                    Auth::user()->id
                                                                ));

        return response()->json($arraySeguimiento);
    }

    public function GetListSeguimientoByIdAsignacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdAsignacionContactoVendedor = $request->nidasignacioncontactovendedor;

        $arraySeguimiento = DB::select('exec [usp_Contacto_GetListSeguimientoByIdAsignacion] ?',
                                                            [  $nIdAsignacionContactoVendedor
                                                            ]);

        $arraySeguimiento = ParametroController::arrayPaginator($arraySeguimiento, $request);
        return ['arraySeguimiento'=>$arraySeguimiento];
    }

    public function GetListContactosLibres(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nTipoPersona       =   $request->ntipopersona;
        $cNroDocumento      =   $request->cnrodocumento;
        $cFiltroDescripcion =   $request->cfiltrodescripcion;
        $nTipoContacto      =   $request->ntipocontacto;

        $cNroDocumento      =   ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cFiltroDescripcion =   ($cFiltroDescripcion == NULL) ? ($cFiltroDescripcion = ' ') : $cFiltroDescripcion;

        $arrayContactoLibre = DB::select('exec [usp_Contacto_GetListContactosLibres] ?, ?, ?, ?, ?',
                                                                    [   $nTipoPersona,
                                                                        $cNroDocumento,
                                                                        $cFiltroDescripcion,
                                                                        $nTipoContacto,
                                                                        Auth::user()->id
                                                                    ]);

        $arrayContactoLibre = ParametroController::arrayPaginator($arrayContactoLibre, $request);
        return ['arrayContactoLibre'=>$arrayContactoLibre];
    }

    public function GetListReferenciaVehiculoLibre(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdContacto = $request->nidcontacto;

        $arrayReferenciaLibre = DB::select('exec [usp_Contacto_GetListReferenciaVehiculoLibre] ?',
                                                                    [  $nIdContacto
                                                                    ]);

        $arrayReferenciaLibre = ParametroController::arrayPaginator($arrayReferenciaLibre, $request);
        return ['arrayReferenciaLibre'=>$arrayReferenciaLibre];
    }

    public function SetAsignaReferenciaLibre(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayRefLibre = DB::select('exec [usp_Contacto_SetAsignaReferenciaLibre] ?, ?, ?, ?, ?, ?',
                                                    [   $request->nIdReferenciaVehiculoContacto,
                                                        $request->nIdEmpresa,
                                                        $request->nIdSucursal,
                                                        $request->nIdCronograma,
                                                        $request->nIdVendedor,
                                                        Auth::user()->id
                                                    ]);

        return response()->json($arrayRefLibre);
    }

    /*public function GetRefVehiculoByContactoPorReasignar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdContacto = $request->nidcontacto;
        $nIdVendedor = $request->nidvendedor;

        $arrayReasignarReferencia = DB::select('exec usp_Contacto_GetRefVehiculoByContacto ?, ?, ?, ?',
                                                                            [   $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $nIdContacto,
                                                                                $nIdVendedor
                                                                            ]);

        $arrayReasignarReferencia = ParametroController::arrayPaginator($arrayReasignarReferencia, $request);
        return ['arrayReasignarReferencia'=>$arrayReasignarReferencia];
    }*/

    public function UpdReasignarReferenciaVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayReasignarRef = DB::select('exec [usp_Contacto_UpdReasignarReferenciaVehiculo] ?, ?, ?, ?, ?, ?, ?',
                                                            [       $request->nIdAsignacionContactoVendedor,
                                                                    $request->nIdReferenciaVehiculoContacto,
                                                                    $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdCronograma,
                                                                    $request->nIdVendedor,
                                                                    Auth::user()->id
                                                            ]);

        return response()->json($arrayReasignarRef);
    }

    //Acciones Mis Contactos
    public function GetListContactoByJFV(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $nIdCronograma      =   $request->nidcronograma;
        $nTipoPersona       =   $request->ntipopersona;
        $cNroDocumento      =   $request->cnrodocumento;
        $cFiltroDescripcion =   $request->cfiltrodescripcion;

        $cNroDocumento      =   ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cFiltroDescripcion =   ($cFiltroDescripcion == NULL) ? ($cFiltroDescripcion = ' ') : $cFiltroDescripcion;

        $arrayContacto = DB::select('exec usp_Contacto_GetListContactoByJFV ?, ?, ?, ?, ?, ?, ?',
                                                                    array(  $nIdEmpresa,
                                                                            $nIdSucursal,
                                                                            $nIdCronograma,
                                                                            $nTipoPersona,
                                                                            $cNroDocumento,
                                                                            $cFiltroDescripcion,
                                                                            Auth::user()->id
                                                                    ));

        $arrayContacto = ParametroController::arrayPaginator($arrayContacto, $request);
        return ['arrayContacto'=>$arrayContacto];
    }

    public function GetListContactoByVendedor(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $nIdCronograma      =   $request->nidcronograma;
        $nTipoPersona       =   $request->ntipopersona;
        $cNroDocumento      =   $request->cnrodocumento;
        $cFiltroDescripcion =   $request->cfiltrodescripcion;
        $nIdVendedor        =   $request->nidvendedor;

        $cNroDocumento      =   ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cFiltroDescripcion =   ($cFiltroDescripcion == NULL) ? ($cFiltroDescripcion = ' ') : $cFiltroDescripcion;
        $nIdVendedor        =   ($nIdVendedor == NULL) ? ($nIdVendedor = Auth::user()->id) : $nIdVendedor;
        $nTipoPersona       =   ($nTipoPersona == NULL) ? ($nTipoPersona = 1) : $nTipoPersona;

        $arrayContactosPorVendedor = DB::select('exec [usp_Contacto_GetListContactoByVendedor] ?, ?, ?, ?, ?, ?, ?, ?',
                                                                    [   $nIdEmpresa,
                                                                        $nIdSucursal,
                                                                        $nIdCronograma,
                                                                        $nTipoPersona,
                                                                        $cNroDocumento,
                                                                        $cFiltroDescripcion,
                                                                        $nIdVendedor,
                                                                        Auth::user()->id
                                                                    ]);
        return ['arrayContactosPorVendedor'=>$arrayContactosPorVendedor];
    }

    public function GetListVendedoresByJFV(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $cNombreVendedor = $request->cnombrevendedor;

        $cNombreVendedor = ($cNombreVendedor == NULL) ? ($cNombreVendedor = ' ') : $cNombreVendedor;

        $arrayVendedor = DB::select('exec usp_Contacto_GetListVendedoresByJFV ?, ?',
                                                                        array(  $cNombreVendedor,
                                                                                Auth::user()->id
                                                                                ));

        $arrayVendedor = ParametroController::arrayPaginator($arrayVendedor, $request);
        return ['arrayVendedor'=>$arrayVendedor];
    }

    public function UpdReasignarContacto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $idasignacion   =   $request->asigcontactvendedor;
        $idvendedor     =   $request->vendedor;
        $idusuario      =   Auth::user()->id;

        $data = DB::select('exec usp_Contacto_UpdReasignarContacto ?, ?, ?',
                                                            array(  $idasignacion,
                                                                    $idvendedor,
                                                                    $idusuario
                                                                ));

        return ['data' => $data];
    }

    public function GetRefVehiculoByContacto_JFV(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     =   $request->nidempresa;
        $nIdSucursal    =   $request->nidsucursal;
        $nIdContacto    =   $request->nidcontacto;

        $arraySegReferenciavehiculo = DB::select('exec usp_Contacto_GetRefVehiculoByContacto_JFV ?, ?, ?',
                                                                        array(  $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $nIdContacto
                                                                                ));

        $arraySegReferenciavehiculo = ParametroController::arrayPaginator($arraySegReferenciavehiculo, $request);
        return ['arraySegReferenciavehiculo'=>$arraySegReferenciavehiculo];
    }

    public function SetLeads(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                DB::select('exec usp_Contacto_SetLeads ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [
                                                                $det['cTipoDocumento'],
                                                                $det['cNumeroDocumento'],
                                                                $det['cNombre'],
                                                                $det['cApellidoPaterno'],
                                                                $det['cApellidoMaterno'],
                                                                $det['cTelefonoFijo'],
                                                                $det['nTelefonoMovil'],
                                                                $det['cEmail'],
                                                                $det['cDepartamentoNombre'],
                                                                $det['cProvinciaNombre'],
                                                                $det['cDistritoNombre'],
                                                                $det['cDireccion'],
                                                                $det['cLineaNombre'],
                                                                $det['cMarcaNombre'],
                                                                $det['cModeloNombre'],
                                                                $det['nAnioFabricacion'],
                                                                $det['nAnioModelo'],
                                                                $det['cGlosa'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetEstadoAsignacionSeguimiento(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa                     =   $request->nidempresa;
        $nIdSucursal                    =   $request->nidsucursal;
        $nIdAsignacionContactoVendedor  =   $request->nidasignacioncontactovendedor;

        $arrayEstadoSeguimiento = DB::select('exec [usp_Contacto_GetEstadoAsignacionSeguimiento] ?, ?, ?',
                                                                [   $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $nIdAsignacionContactoVendedor
                                                                ]);
        return ['arrayEstadoSeguimiento'=>$arrayEstadoSeguimiento];
    }

    public function desactivarSeguimiento(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $objSeguimiento = DB::select('exec [usp_Contacto_DesactivaSeguimientoById] ?, ?',
                                                    [   $request->nIdSeguimientoContacto,
                                                        Auth::user()->id
                                                    ]);
        return response()->json($objSeguimiento);
    }

    public function SetAmpliacionFechaVenceAsignacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $objAsignacion = DB::select('exec [usp_Contacto_SetAmpliacionFechaVenceAsignacion] ?, ?, ?, ?, ?, ?',
                                                        [   $request->nIdAsignacionContactoVendedor,
                                                            $request->nIdReferenciaVehiculoContacto,
                                                            $request->nIdEmpresa,
                                                            $request->nIdSucursal,
                                                            $request->nNroDias,
                                                            Auth::user()->id
                                                        ]);

        return response()->json($objAsignacion);
    }

    public function UpdCardCodeContacto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdContacto    =   $request->nIdContacto;
        $CardCode       =   $request->CardCode;
        $CardType       =   $request->CardType;
        $LogRespuesta   =   $request->LogRespuesta;
        $nIdUsuario     =   Auth::user()->id;

        $data = DB::select('exec [usp_Contacto_UpdCardCodeContacto] ?, ?, ?, ?, ?',
                                                            [
                                                                $nIdContacto,
                                                                $CardCode,
                                                                $CardType,
                                                                $LogRespuesta,
                                                                $nIdUsuario
                                                            ]);

        return response()->json($data);
    }

    public function SetPatchContactoPerNatural(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $cFlagOp            =   $request->cFlagOp;
        $nIdContacto        =   $request->nIdContacto;
        $nIdPernatural      =   $request->nIdPernatural;
        $nIdPerjudirica     =   $request->nIdPerjudirica;
        //Datos Personales
        $cNumeroDocumento   =   $request->cNumeroDocumento;
        $cNombre            =   $request->cNombre;
        $cPrimerNombre      =   $request->cPrimerNombre;
        $cSegundoNombre     =   $request->cSegundoNombre;
        $cApellidoPaterno   =   $request->cApellidoPaterno;
        $cApellidoMaterno   =   $request->cApellidoMaterno;
        $dFechaNacimiento   =   $request->dFechaNacimiento;
        //Datos de Contacto
        $cDireccion         =   $request->cDireccion;
        $cEmail             =   $request->cEmail;
        $nTelefonoMovil     =   $request->nTelefonoMovil;
        $cUbigeo            =   $request->cUbigeo;
        $nIdEstadoCivil     =   $request->nIdEstadoCivil;
        $nTelfMovilAlter    =   $request->nTelefonoMovilAlternativo;
        $cTelefonoFijo      =   $request->cTelefonoFijo;

        $nIdContacto        =   ($nIdContacto == NULL) ? ($nIdContacto = 0) : $nIdContacto;
        $nIdPernatural      =   ($nIdPernatural == NULL) ? ($nIdPernatural = 0) : $nIdPernatural;
        $nIdPerjudirica     =   ($nIdPerjudirica == NULL) ? ($nIdPerjudirica = 0) : $nIdPerjudirica;
        $cNumeroDocumento   =   ($cNumeroDocumento == NULL) ? ($cNumeroDocumento = '') : $cNumeroDocumento;
        $cNombre            =   ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
        $cPrimerNombre      =   ($cPrimerNombre == NULL) ? ($cPrimerNombre = '') : $cPrimerNombre;
        $cSegundoNombre     =   ($cSegundoNombre == NULL) ? ($cSegundoNombre = '') : $cSegundoNombre;
        $cApellidoPaterno   =   ($cApellidoPaterno == NULL) ? ($cApellidoPaterno = '') : $cApellidoPaterno;
        $cApellidoMaterno   =   ($cApellidoMaterno == NULL) ? ($cApellidoMaterno = '') : $cApellidoMaterno;
        $dFechaNacimiento   =   ($dFechaNacimiento == NULL) ? ($dFechaNacimiento = '') : $dFechaNacimiento;
        $cDireccion         =   ($cDireccion == NULL) ? ($cDireccion = '') : $cDireccion;
        $cEmail             =   ($cEmail == NULL) ? ($cEmail = '') : $cEmail;
        $nTelefonoMovil     =   ($nTelefonoMovil == NULL) ? ($nTelefonoMovil = '') : $nTelefonoMovil;
        $cUbigeo            =   ($cUbigeo == NULL) ? ($cUbigeo = '') : $cUbigeo;
        $nIdEstadoCivil     =   ($nIdEstadoCivil == NULL) ? ($nIdEstadoCivil = 0) : $nIdEstadoCivil;
        $nTelfMovilAlter    =   ($nTelfMovilAlter == NULL) ? ($nTelfMovilAlter = 0) : $nTelfMovilAlter;
        $cTelefonoFijo      =   ($cTelefonoFijo == NULL) ? ($cTelefonoFijo = '') : $cTelefonoFijo;

        $arrayContacto = DB::select('exec [usp_Contacto_SetPatchContactoPerNatural] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [
                                                                $cFlagOp,
                                                                $nIdContacto,
                                                                $nIdPernatural,
                                                                $nIdPerjudirica,
                                                                $cNumeroDocumento,
                                                                $cNombre,
                                                                $cPrimerNombre,
                                                                $cSegundoNombre,
                                                                $cApellidoPaterno,
                                                                $cApellidoMaterno,
                                                                $dFechaNacimiento,
                                                                $cDireccion,
                                                                $cEmail,
                                                                $nTelefonoMovil,
                                                                $cUbigeo,
                                                                $nIdEstadoCivil,
                                                                $nTelfMovilAlter,
                                                                $cTelefonoFijo,
                                                                Auth::user()->id
                                                            ]);

        return response()->json($arrayContacto);
    }

    public function desactivaReferencia(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $objSeguimiento = DB::select('exec [usp_Contacto_DesactivaReferencia] ?, ?, ?',
                                                    [   $request->nIdReferenciaVehiculoContacto,
                                                        $request->nIdContacto,
                                                        Auth::user()->id
                                                    ]);
        return response()->json($objSeguimiento);
    }

    public function GetValidaPerDocumentoByTipo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nTipoPersona       =   $request->ntipopersona;
        $nIdTipoDocumento   =   $request->nidtipodocumento;
        $cNumeroDocumento   =   $request->cnumerodocumento;

        $arrayDocumento = DB::select('exec [usp_Contacto_GetValidaPerDocumentoByTipo] ?, ?, ?, ?',
                                                                [   $nTipoPersona,
                                                                    $nIdTipoDocumento,
                                                                    $cNumeroDocumento,
                                                                    Auth::user()->id
                                                                ]);
        return response()->json($arrayDocumento);
    }

}

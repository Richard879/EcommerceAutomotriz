<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class AutorizacionController extends Controller
{
    public function GetLstVehiculosByCriterio(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa  = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $cNumeroVehiculo  = $request->cnrovehiculo;
        $nCriterio  = $request->criterio;

        $cNumeroVehiculo  = ($cNumeroVehiculo == NULL) ? ($cNumeroVehiculo = ' ') : $cNumeroVehiculo;

        $arrayVehiculosByCriterio = DB::select('exec usp_Autorizacion_GetLstVehiculosByCriterio ?, ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $cNumeroVehiculo,
                                                                $nCriterio
                                                            ]);

        $arrayVehiculosByCriterio = ParametroController::arrayPaginator($arrayVehiculosByCriterio, $request);
        return ['arrayVehiculosByCriterio'=>$arrayVehiculosByCriterio];
    }

    public function GetLstContactosByUsuario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCronograma = $request->nidcronograma;
        $nTipoPersona = $request->ntipopersona;
        $cNroDocumento = $request->cnrodocumento;
        $cFiltroDescripcion = $request->cfiltrodescripcion;
        $nIdTipoRol  = $request->tipoRol;

        switch ($nIdTipoRol) {
            case 1:
                $nIdVendedor = Auth::user()->id;
                break;
            case 2:
                $nIdVendedor = Auth::user()->id;
                break;
            case 3:
                $nIdVendedor = 0;
                break;
            default:
                $nIdVendedor = 0;
                break;
        }

        $cNroDocumento = ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cFiltroDescripcion = ($cFiltroDescripcion == NULL) ? ($cFiltroDescripcion = ' ') : $cFiltroDescripcion;

        $arrayContactosByUsuario = DB::select('exec usp_Autorizacion_GetListContactosByUsuario ?, ?, ?, ?, ?, ?, ?, ?',
                                                                        [
                                                                            $nIdEmpresa,
                                                                            $nIdSucursal,
                                                                            $nIdCronograma,
                                                                            $nTipoPersona,
                                                                            $cNroDocumento,
                                                                            $cFiltroDescripcion,
                                                                            $nIdTipoRol,
                                                                            $nIdVendedor
                                                                        ]);

        $arrayContactosByUsuario = ParametroController::arrayPaginator($arrayContactosByUsuario, $request);
        return ['arrayContactosByUsuario'=>$arrayContactosByUsuario];
    }

    public function SetRegistrarSolicitudAutorizacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdAsigContacto = $request->nIdAsigContacto;
        $nIdAsigContacto = ($nIdAsigContacto == NULL) ? ($nIdAsigContacto = NULL) : $nIdAsigContacto;
        $cFlagJeveVentas = $request->cFlagJeveVentas;

        $nIdVehiculoPlaca = $request->nIdVehiculoPlaca;
        $nIdCompra = $request->nIdCompra;

        $nIdVehiculoPlaca = ($nIdVehiculoPlaca == NULL) ? ($nIdVehiculoPlaca = 0) : $nIdVehiculoPlaca;
        $nIdCompra = ($nIdCompra == NULL) ? ($nIdCompra = 0) : $nIdCompra;


        $data = DB::select('exec usp_Autorizacion_SetRegistrarSolicitudAutorizacion ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nIdAsigContacto,
                                        $nIdVehiculoPlaca,
                                        $nIdCompra,
                                        $request->nIdEmpresa,
                                        $request->nIdSucursal,
                                        $request->nIdTipoSolicitud,
                                        $request->dFechaSolicitud,
                                        $request->cFlagContacto,
                                        $request->cFlagVinPlaca,
                                        $request->dFechaMovVehiculo,
                                        $request->cHoraMovVehiculo,
                                        $request->cObservacion,
                                        $request->cLugarPartida,
                                        $request->cLugarLlegada,
                                        $request->nIdMoverVehiculo,
                                        $request->nIdEstadoSolAutori,
                                        trim($request->cFlagEstadoSolAutori),
                                        Auth::user()->id
                                    ]);

        switch ($cFlagJeveVentas) {
            case 'JV':
                //OBTENGO DATA DE LA SOLICITUD AUTORIZACIÓN
                $nIdSolicitudAutorizacion =  $data[0];
                break;
            case 'ADV':
                //OBTENGO DATA DE LA SOLICITUD AUTORIZACIÓN
                $nIdSolicitudAutorizacion =  $data[0];
                break;
            default:
                //OBTENGO EL ID DE LA SOLICITUD AUTORIZACIÓN
                $nIdSolicitudAutorizacion =  $data[0]->nIdSolicitudAutorizacion;
                break;
        }

        return response()->json($nIdSolicitudAutorizacion);
    }

    public function GetLstMisSolicitudes(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdTipoBusquedaVehiculo = $request->nIdTipoBusquedaVehiculo;
        $cNroVehiculo = $request->cNroVehiculo;
        $dFechaInicio = $request->dFechaInicio;
        $dFechaFin = $request->dFechaFin;
        $nIdAsigContacto = $request->nIdAsigContacto;
        $nIdEstado = $request->nIdEstado;
        $nTipoRol = $request->tipoRol;
        $nIdTipoBusquedaAutorizacion = $request->nIdTipoBusquedaAutorizacion;
        $cFlagEstadoAutorizacion = $request->cFlagEstadoAutorizacion;
        $nIdSolicitudAutorizacion = $request->nIdSolicitudAutorizacion;
        $nIdVendedor = $request->nIdVendedor;

        $nIdTipoBusquedaVehiculo = ($nIdTipoBusquedaVehiculo == NULL) ? ($nIdTipoBusquedaVehiculo = 0) : $nIdTipoBusquedaVehiculo;
        $cNroVehiculo = ($cNroVehiculo == NULL) ? ($cNroVehiculo = '') : $cNroVehiculo;
        $dFechaInicio = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $nIdAsigContacto = ($nIdAsigContacto == NULL) ? ($nIdAsigContacto = 0) : $nIdAsigContacto;
        $nIdTipoBusquedaAutorizacion = ($nIdTipoBusquedaAutorizacion == NULL) ? ($nIdTipoBusquedaAutorizacion = 0) : $nIdTipoBusquedaAutorizacion;
        $cFlagEstadoAutorizacion = ($cFlagEstadoAutorizacion == NULL) ? ($cFlagEstadoAutorizacion = 0) : $cFlagEstadoAutorizacion;
        $nIdSolicitudAutorizacion = ($nIdSolicitudAutorizacion == NULL) ? ($nIdSolicitudAutorizacion = 0) : $nIdSolicitudAutorizacion;
        $nIdEstado = ($nIdEstado == NULL) ? ($nIdEstado = 0) : $nIdEstado;

        $arrayMisSolicitudes = DB::select('exec [usp_Autorizacion_GetLstMisAutorizaciones] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                        [
                                                                            $nIdTipoBusquedaVehiculo,
                                                                            $cNroVehiculo,
                                                                            $dFechaInicio,
                                                                            $dFechaFin,
                                                                            $nIdAsigContacto,
                                                                            $nIdEstado,
                                                                            $nTipoRol,
                                                                            $nIdTipoBusquedaAutorizacion,
                                                                            $cFlagEstadoAutorizacion,
                                                                            $nIdSolicitudAutorizacion,
                                                                            Auth::user()->id
                                                                        ]);

        $arrayMisSolicitudes = ParametroController::arrayPaginator($arrayMisSolicitudes, $request);
        return ['arrayMisSolicitudes'=>$arrayMisSolicitudes];
    }

    public function GetLstSolicitudesByTodos(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdTipoBusquedaVehiculo = $request->nIdTipoBusquedaVehiculo;
        $cNroVehiculo = $request->cNroVehiculo;
        $dFechaInicio = $request->dFechaInicio;
        $dFechaFin = $request->dFechaFin;
        $nIdAsigContacto = $request->nIdAsigContacto;
        $nIdEstado = $request->nIdEstado;
        $nTipoRol = $request->tipoRol;
        $nIdTipoBusquedaAutorizacion = $request->nIdTipoBusquedaAutorizacion;
        $cFlagEstadoAutorizacion = $request->cFlagEstadoAutorizacion;
        $nIdSolicitudAutorizacion = $request->nIdSolicitudAutorizacion;
        $nIdVendedor = $request->nIdVendedor;

        $nIdTipoBusquedaVehiculo = ($nIdTipoBusquedaVehiculo == NULL) ? ($nIdTipoBusquedaVehiculo = 0) : $nIdTipoBusquedaVehiculo;
        $cNroVehiculo = ($cNroVehiculo == NULL) ? ($cNroVehiculo = '') : $cNroVehiculo;
        $dFechaInicio = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $nIdAsigContacto = ($nIdAsigContacto == NULL) ? ($nIdAsigContacto = 0) : $nIdAsigContacto;
        $nIdTipoBusquedaAutorizacion = ($nIdTipoBusquedaAutorizacion == NULL) ? ($nIdTipoBusquedaAutorizacion = 0) : $nIdTipoBusquedaAutorizacion;
        $cFlagEstadoAutorizacion = ($cFlagEstadoAutorizacion == NULL) ? ($cFlagEstadoAutorizacion = 0) : $cFlagEstadoAutorizacion;
        $nIdSolicitudAutorizacion = ($nIdSolicitudAutorizacion == NULL) ? ($nIdSolicitudAutorizacion = 0) : $nIdSolicitudAutorizacion;
        $nIdEstado = ($nIdEstado == NULL) ? ($nIdEstado = 0) : $nIdEstado;

        $arrayMisSolicitudes = DB::select('exec [usp_Autorizacion_GetLstAutorizacionesByTodos] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                        [
                                                                            $nIdTipoBusquedaVehiculo,
                                                                            $cNroVehiculo,
                                                                            $dFechaInicio,
                                                                            $dFechaFin,
                                                                            $nIdAsigContacto,
                                                                            $nIdEstado,
                                                                            $nTipoRol,
                                                                            $nIdTipoBusquedaAutorizacion,
                                                                            $cFlagEstadoAutorizacion,
                                                                            $nIdSolicitudAutorizacion,
                                                                            Auth::user()->id
                                                                        ]);

        $arrayMisSolicitudes = ParametroController::arrayPaginator($arrayMisSolicitudes, $request);
        return ['arrayMisSolicitudes'=>$arrayMisSolicitudes];
    }

    public function SetConformeNoConforme(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdSolicitudAutorizacion = $request->nIdSolicitudAutorizacion;
        $nIdEstadoSolicitudAutorizacion = $request->nIdEstadoSolicitudAutorizacion;
        $cFlagEstadoAutorizacionControl = $request->cFlagEstadoAutorizacionControl;
        $cNombreSupervisorInmediato = $request->cNombreSupervisorInmediato;
        $nIdSupervisorInmediato = Auth::user()->id;
        $objDetalleSolicitudAutorizacion = $request->objDetalleSolicitudAutorizacion;
        $modalidadRecibirData = $request->modalidadRecibirData;

        $data = DB::select('exec usp_Autorizacion_SetCambiarEstado ?, ?, ?, ?, ?, ?',
                                                [
                                                    $nIdSolicitudAutorizacion,
                                                    $nIdEstadoSolicitudAutorizacion,
                                                    trim($cFlagEstadoAutorizacionControl),
                                                    $cNombreSupervisorInmediato,
                                                    $nIdSupervisorInmediato,
                                                    $modalidadRecibirData
                                                ]);

        $ruta = Storage::makeDirectory('public/SolicitudAutorizacion/conformeNOconforme');//CONSTRUYO EL DIRECTORIO DINAMICAMENTE
        $bandera = str_random(10);//RANDOM 10 ALPHA NÚMERICO
        $nombrePDFOriginal  = $request->cNombreSolicitudAutorizacion . '.pdf';//NOMBRE ORIGINAL DEL ARCHIVO
        $nombrePDFToken     = $bandera .'_'. $nombrePDFOriginal;//NOMBRE ORIGINAL DEL ARCHIVO + TOKEN
        $path = storage_path("app/public/SolicitudAutorizacion/conformeNOconforme/{$nombrePDFToken}");//CAPTURO LA RUTA DEL DIRECTORIO + NOMBRE DEL ARCHIVO
        $pdf = \PDF::loadView('pdf.solicitudautorizacion.detallesolicitud', ['objDetalleSolicitudAutorizacion'   =>  $objDetalleSolicitudAutorizacion])->save($path);//ALMACENO EL ARCHIVO EN EL SERVIDOR

        //REGISTRO EN LA DB LA RUTA, NOMBRE Y USUARIO
        $arrayDocumento = DB::select('exec usp_Pedido_SetDocumentoAdjunto ?, ?, ?',
                                                        [
                                                            asset('storage/SolicitudAutorizacion/conformeNOconforme/'. $nombrePDFToken),
                                                            $nombrePDFOriginal,
                                                            $nIdSupervisorInmediato
                                                        ]);
        //OBTENGO EL ID DEL DOCUMENTO GUARDADO
        $nIdDocumentoAdjunto =  $arrayDocumento[0]->nIdDocumentoAdjunto;
        //ACTUALIZO EL ID EN LA TABLA SCC
        DB::select('exec usp_Autorizacion_SetIdDocumentoAdjunto ?, ?', [$nIdSolicitudAutorizacion, $nIdDocumentoAdjunto]);
    }

    public function GetRefVehiculoByContacto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdContacto = $request->nidcontacto;

        $arraySegReferenciavehiculo = DB::select('exec [usp_Cotizacion_GetRefVehiculoByContacto] ?, ?, ?, ?',
                                                                            [   $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $nIdContacto,
                                                                                0
                                                                            ]);

        $arraySegReferenciavehiculo = ParametroController::arrayPaginator($arraySegReferenciavehiculo, $request);
        return ['arraySegReferenciavehiculo'=>$arraySegReferenciavehiculo];
    }
}

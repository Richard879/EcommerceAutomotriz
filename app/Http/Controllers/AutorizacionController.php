<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class AutorizacionController extends Controller
{
    public function arrayPaginator($array, $request)
    {
        $page = $request->page;
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        $array = new Collection($array);
        $result = $array->forPage($page, $perPage)->values()->all();
        return  new LengthAwarePaginator($result, $array->count(), $perPage,$page);
    }

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

        $arrayVehiculosByCriterio = $this->arrayPaginator($arrayVehiculosByCriterio, $request);
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
        $nIdVendedor = Auth::user()->id;

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

        $arrayContactosByUsuario = $this->arrayPaginator($arrayContactosByUsuario, $request);
        return ['arrayContactosByUsuario'=>$arrayContactosByUsuario];
    }

    public function SetRegistrarSolicitudAutorizacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdAsigContacto = $request->nIdAsigContacto;
        $nIdAsigContacto = ($nIdAsigContacto == NULL) ? ($nIdAsigContacto = NULL) : $nIdAsigContacto;

        $data = DB::select('exec usp_Autorizacion_SetRegistrarSolicitudAutorizacion ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nIdAsigContacto,
                                        $request->nIdVehiculoPlaca,
                                        $request->nIdCompra,
                                        $request->nIdEmpresa,
                                        $request->nIdSucursal,
                                        $request->nIdTipoSolicitud,
                                        $request->cNumeroSolicitud,
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
                                        Auth::user()->id
                                    ]);
        //OBTENGO EL ID DE LA SOLICITUD AUTORIZACIÓN
        $nIdSolicitudAutorizacion =  $data[0]->nIdSolicitudAutorizacion;

        return response()->json($nIdSolicitudAutorizacion);
    }

    public function GetLstSolicitudes(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdTipoBusquedaVehiculo = $request->nIdTipoBusquedaVehiculo;
        $cNroVehiculo = $request->cNroVehiculo;
        $dFecha = $request->dFecha;
        $nIdAsigContacto = $request->nIdAsigContacto;
        $nIdEstado = $request->nIdEstado;
        $nTipoRol = $request->tipoRol;
        $nIdTipoBusquedaAutorizacion = $request->nIdTipoBusquedaAutorizacion;
        $nIdVendedor = $request->nIdVendedor;

        switch ($nTipoRol) {
            case 1:
                swItch ($nIdTipoBusquedaAutorizacion) {
                    case 1:
                        $nIdVendedor = Auth::user()->id;
                        break;
                    default:
                        $nIdVendedor = 0;
                        break;
                }
                break;
            case 2:
                swItch ($nIdTipoBusquedaAutorizacion) {
                    case 1:
                        $nIdVendedor = Auth::user()->id;
                        break;
                    case 2:
                        $nIdVendedor = ($nIdVendedor == null) ? 0 : $nIdVendedor;
                        break;
                    default:
                        $nIdVendedor = 0;
                        break;
                }
                break;
            case 3:
                swItch ($nIdTipoBusquedaAutorizacion) {
                    case 1:
                        $nIdVendedor = Auth::user()->id;
                        break;
                    case 2:
                        $nIdVendedor = ($nIdVendedor == null) ? 0 : $nIdVendedor;
                        break;
                    default:
                        $nIdVendedor = 0;
                        break;
                }
                break;
            default:
                $nIdVendedor = 0;
                break;
        }

        $nIdTipoBusquedaVehiculo = ($nIdTipoBusquedaVehiculo == NULL) ? ($nIdTipoBusquedaVehiculo = 0) : $nIdTipoBusquedaVehiculo;
        $cNroVehiculo = ($cNroVehiculo == NULL) ? ($cNroVehiculo = '') : $cNroVehiculo;
        $dFecha = ($dFecha == NULL) ? ($dFecha = ' ') : $dFecha;
        $nIdAsigContacto = ($nIdAsigContacto == NULL) ? ($nIdAsigContacto = 0) : $nIdAsigContacto;
        $nIdTipoBusquedaAutorizacion = ($nIdTipoBusquedaAutorizacion == NULL) ? ($nIdTipoBusquedaAutorizacion = 0) : $nIdTipoBusquedaAutorizacion;
        $nIdEstado = ($nIdEstado == NULL) ? ($nIdEstado = 0) : $nIdEstado;



        $arrayMisSolicitudes = DB::select('exec usp_Autorizacion_GetLstAutorizaciones ?, ?, ?, ?, ?, ?, ?, ?',
                                                                        [
                                                                            $nIdTipoBusquedaVehiculo,
                                                                            $cNroVehiculo,
                                                                            $dFecha,
                                                                            $nIdAsigContacto,
                                                                            $nIdEstado,
                                                                            $nTipoRol,
                                                                            $nIdTipoBusquedaAutorizacion,
                                                                            $nIdVendedor
                                                                        ]);

        $arrayMisSolicitudes = $this->arrayPaginator($arrayMisSolicitudes, $request);
        return ['arrayMisSolicitudes'=>$arrayMisSolicitudes];
    }


}

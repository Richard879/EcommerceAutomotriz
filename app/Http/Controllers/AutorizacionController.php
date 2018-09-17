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

        $data = DB::select('exec usp_Autorizacion_SetRegistrarSolicitudAutorizacion ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $request->nIdAsigContacto,
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

        $nIdTipoBusqueda = $request->nIdTipoBusqueda;
        $nIdVehiculo = $request->nIdVehiculo;
        $dFecha = $request->dFecha;
        $nIdAsigContacto = $request->nIdAsigContacto;
        $nIdEstado = $request->nIdEstado;
        $nTipoRol = $request->tipoRol;
        $nIdVendedor = $request->nIdVendedor;

        switch ($nTipoRol) {
            case 1:
                $nIdVendedor = Auth::user()->id;
                break;
            case 21:
                $nIdVendedor = ($nIdVendedor == null) ? 0 : $nIdVendedor;
                break;
            case 22:
                $nIdVendedor = Auth::user()->id;
                break;
            case 31:
                $nIdVendedor = ($nIdVendedor == null) ? 0 : $nIdVendedor;
                break;
            case 32:
                $nIdVendedor = Auth::user()->id;
                break;
            default:
                $nIdVendedor = 0;
                break;
        }

        $nIdTipoBusqueda = ($nIdTipoBusqueda == NULL) ? ($nIdTipoBusqueda = ' ') : $nIdTipoBusqueda;
        $nIdVehiculo = ($nIdVehiculo == NULL) ? ($nIdVehiculo = 0) : $nIdVehiculo;
        $dFecha = ($dFecha == NULL) ? ($dFecha = ' ') : $dFecha;
        $nIdAsigContacto = ($nIdAsigContacto == NULL) ? ($nIdAsigContacto = ' ') : $nIdAsigContacto;
        $nIdEstado = ($nIdEstado == NULL) ? ($nIdEstado = 0) : $nIdEstado;

        $arrayMisSolicitudes = DB::select('exec usp_CartaCaracteristica_GetLstCartaCaracteristica ?, ?, ?, ?, ?, ?, ?',
                                                                        [
                                                                            $nIdTipoBusqueda,
                                                                            $nIdVehiculo,
                                                                            $dFecha,
                                                                            $nIdAsigContacto,
                                                                            $nIdEstado,
                                                                            $nTipoRol,
                                                                            $nIdVendedor
                                                                        ]);

        $arrayMisSolicitudes = $this->arrayPaginator($arrayMisSolicitudes, $request);
        return ['arrayMisSolicitudes'=>$arrayMisSolicitudes];
    }


}

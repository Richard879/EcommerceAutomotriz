<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PdiProcesoController extends Controller
{
    public function GetListSolicitudByEstado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa  = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdEstadoSolicitud = $request->nidestadosolicitud;
                
        $arraySolicitud = DB::select('exec [usp_Pdi_GetListSolicitudByEstado] ?, ?, ?', 
                                                                    [   $nIdEmpresa, 
                                                                        $nIdSucursal,
                                                                        $nIdEstadoSolicitud
                                                                    ]);

        $arraySolicitud = ParametroController::arrayPaginator($arraySolicitud, $request);
        return ['arraySolicitud'=>$arraySolicitud];
    }

    public function GetListCompra(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $dFechaInicio = $request->dfechainicio;
        $dFechaFin = $request->dfechafin;
        $nOrdenCompra = $request->nordencompra;
        $cNumeroVin = $request->cnumerovin;
        $nIdMarca   = $request->nidmarca;
        $nIdModelo  = $request->nidmodelo;

        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = ' ') : $cNumeroVin;
        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;

        $arrayCompra = DB::select('exec [usp_Pdi_GetListCompra] ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $dFechaInicio,
                                                                $dFechaFin,
                                                                $nOrdenCompra,
                                                                $cNumeroVin,
                                                                $nIdMarca,
                                                                $nIdModelo
                                                            ]);

        $arrayCompra = Parametro::arrayPaginator($arrayCompra, $request);
        return ['arrayCompra'=>$arrayCompra];
    }

    public function GetListSeccion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa   = $request->nidempresa;
        $nIdTipoInspeccion = $request->nidtipoinspeccion;
        $nIdFlag = $request->nidflag;
        $nIdFlag = ($nIdFlag == NULL) ? ($nIdFlag = 0) : $nIdFlag;

        $arraySeccion = DB::select('exec [usp_Pdi_GetListSeccion] ?, ?, ?', 
                                                                    [   $nIdEmpresa, 
                                                                        $nIdTipoInspeccion,
                                                                        $nIdFlag
                                                                    ]);
        return response()->json($arraySeccion);
    }

    public function GetListItem(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa   = $request->nidempresa;
        $nIdTipoInspeccion = $request->nidtipoinspeccion;
        $nIdFlag = $request->nidflag;
        $nIdFlag = ($nIdFlag == NULL) ? ($nIdFlag = 0) : $nIdFlag;

        $arrayItems = DB::select('exec [usp_Pdi_GetListItem] ?, ?, ?', 
                                                                    [   $nIdEmpresa, 
                                                                        $nIdTipoInspeccion,
                                                                        $nIdFlag
                                                                    ]);
        return response()->json($arrayItems);
    }

    public function SetCabeceraInspeccion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $pdi = DB::select('exec [usp_Pdi_SetCabeceraInspeccion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdPuntoInspeccion,
                                                                    $request->nIdSolicitudAutorizacion,
                                                                    $request->nIdCompra,
                                                                    $request->nIdVehiculoPlaca,
                                                                    $request->nIdTipoInspeccion,
                                                                    $request->nIdAlmacen,
                                                                    $request->cNumeroInspeccion,
                                                                    $request->dFechaInspeccion,
                                                                    $request->cHoraInspeccion,
                                                                    $request->cFlagTipoMovimiento,
                                                                    $request->cFlagVinPlaca,
                                                                    $request->cNumeroMovimientoAlmacen,
                                                                    $request->dFechaMovimientoAlmacen,
                                                                    $request->cFlagEstadoAprobacion,
                                                                    $request->cObservacion,
                                                                    Auth::user()->id
                                                                ]);
        return response()->json($pdi);
    }

    public function UpdCabeceraInspeccion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $pdi = DB::select('exec [usp_Pdi_UpdCabeceraInspeccion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $request->nIdCabeceraInspeccion,
                                                                    $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdAlmacen,
                                                                    $request->cNumeroInspeccion,
                                                                    $request->dFechaInspeccion,
                                                                    $request->cHoraInspeccion,
                                                                    $request->cNumeroMovimientoAlmacen,
                                                                    $request->dFechaMovimientoAlmacen,
                                                                    $request->cFlagEstadoAprobacion,
                                                                    $request->cObservacion,
                                                                    Auth::user()->id
                                                                ]);
        return response()->json($pdi);
    }

    public function GetLstVehiculoPaca(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa  = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $cNumeroVehiculo  = $request->cnrovehiculo;
        $nCriterio  = $request->criterio;

        $cNumeroVehiculo  = ($cNumeroVehiculo == NULL) ? ($cNumeroVehiculo = ' ') : $cNumeroVehiculo;

        $arrayVehiculoPlaca = DB::select('exec [usp_Pdi_GetLstVehiculoPaca] ?, ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $cNumeroVehiculo,
                                                                $nCriterio
                                                            ]);

        $arrayVehiculoPlaca = Parametro::arrayPaginator($arrayVehiculoPlaca, $request);
        return ['arrayVehiculoPlaca'=>$arrayVehiculoPlaca];
    }

    public function GetListPdi(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nCriterio  = $request->ncriterio;
        $cDescripcionCiterio = $request->cdescripcioncriterio;
        $dFechaInicio = $request->dfechainicio;
        $dFechaFin = $request->dfechafin;
        $nIdEstadoPdi = $request->nidestadopdi;
        
        $nIdEstadoPdi = ($nIdEstadoPdi == NULL) ? ($nIdEstadoPdi = 0) : $nIdEstadoPdi;

        $arrayPdi = DB::select('exec [usp_Pdi_GetListPdi] ?, ?, ?, ?, ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nCriterio,
                                                                $cDescripcionCiterio,
                                                                $dFechaInicio,
                                                                $dFechaFin,
                                                                $nIdEstadoPdi
                                                            ]);

        $arrayPdi = Parametro::arrayPaginator($arrayPdi, $request);
        return ['arrayPdi'=>$arrayPdi];
    }

    public function GetDetalleTipoInspeccionById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa   = $request->nidempresa;
        $nIdTipoInspeccion = $request->nidtipoinspeccion;
                
        $arrayTipoInspeccion = DB::select('exec [usp_Pdi_GetDetalleTipoInspeccionById] ?, ?', 
                                                                    [   $nIdEmpresa, 
                                                                        $nIdTipoInspeccion
                                                                    ]);

        return response()->json($arrayTipoInspeccion);
    }

    public function GetListPuntoInspeccion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa  = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $cNombrePuntoInspeccion = $request->cnombre;

        $cNombrePuntoInspeccion = ($cNombrePuntoInspeccion == NULL) ? ($cNombrePuntoInspeccion = '') : $cNombrePuntoInspeccion;
                
        $arrayPuntoInspeccion = DB::select('exec [usp_Pdi_GetListPuntoInspeccion] ?, ?, ?', 
                                                                                    [   $nIdEmpresa, 
                                                                                        $nIdSucursal,
                                                                                        $cNombrePuntoInspeccion
                                                                                    ]);

        $arrayPuntoInspeccion = ParametroController::arrayPaginator($arrayPuntoInspeccion, $request);
        return ['arrayPuntoInspeccion'=>$arrayPuntoInspeccion];
    }

    public function SetPlantillaPdi(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();
        
            $detalles = $request->data;

            foreach($detalles as $ep=>$det)
            {
                DB::select('exec [usp_Pdi_SetDetallePlantillaPdi] ?, ?, ?, ?, ?', 
                                                    [   $request->nIdCabeceraInspeccion,
                                                        $det['nIdPlantillaInspeccionSeccionItem'],
                                                        $det['cFlagMarca'],
                                                        $det['cDescripcionNoConformidad'],
                                                        Auth::user()->id
                                                    ]);
            }  

            DB::commit(); 
        } catch (Exception $e){
            DB::rollBack();
        }   
    }

    public function SetAccesorioPdi(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();
        
            $detalles = $request->data;

            foreach($detalles as $ep=>$det)
            {
                DB::select('exec [usp_Pdi_SetDetalleAccerioPdi] ?, ?, ?, ?, ?', 
                                                    [   $request->nIdCabeceraInspeccion,
                                                        $det['nIdAccesorio'],
                                                        $det['cFlagMarca'],
                                                        $det['cDescripcionNoConformidad'],
                                                        Auth::user()->id
                                                    ]);
            }  

            DB::commit(); 
        } catch (Exception $e){
            DB::rollBack();
        }   
    }

    public function SetCabeceraInspeccionDocumento(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayPedido = DB::select('exec [usp_Pdi_SetCabeceraInspeccionDocumento] ?, ?, ?',
                                    [
                                        $request->nIdCabeceraInspeccion,
                                        $request->nIdDocumentoAdjunto,
                                        Auth::user()->id
                                    ]);

        return response()->json($arrayPedido);
    }
}
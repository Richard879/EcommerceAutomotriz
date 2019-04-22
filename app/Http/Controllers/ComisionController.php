<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ParametroController as Parametro;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ComisionController extends Controller
{
    public function GetLineasByProveedor(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdProveedor = $request->nidproveedor;
        $cLineaNombre = "";

        $arrayLinea = DB::select('exec [usp_Par_GetLineaByProveedor] ?, ?, ?',
                                            [   $nIdEmpresa,
                                                $nIdProveedor,
                                                $cLineaNombre
                                            ]);

        $arrayLinea = ParametroController::arrayPaginator($arrayLinea, $request);
        return ['arrayLinea'=>$arrayLinea];
    }

    public function GetParametroByGrupo(Request $request)
    {
        $nIdGrupoPar    =   $request->ngrupoparid;
        $variable       =   $request->opcion;

        $parametro = DB::select('exec usp_Par_GetParametroByGrupo ?', array($nIdGrupoPar));

        return response()->json($parametro);
    }

    public function GetListComisiones(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     = $request->nIdEmpresa;
        $nIdSucursal    = $request->nIdSucursal;
        $nIdProveedor   = $request->nIdProveedor;
        $nIdConcepto    = $request->nIdConcepto;
        $nIdTurno       = $request->nIdTurno;
        $cFlagComision  = $request->cFlagComision;
        $cTipoComision  = $request->cTipoComision;
        $cTipoMoneda    = $request->cTipoMoneda;

        $nIdProveedor   = ($nIdProveedor)   == null ? 0 : $nIdProveedor;
        $nIdConcepto    = ($nIdConcepto)    == null ? 0 : $nIdConcepto;
        $nIdTurno       = ($nIdTurno)       == null ? 0 : $nIdTurno;
        $cFlagComision  = ($cFlagComision)  == null ? 0 : $cFlagComision;
        $cTipoComision  = ($cTipoComision)  == null ? '' : $cTipoComision;
        $cTipoMoneda    = ($cTipoMoneda)    == null ? 0 : $cTipoMoneda;

        $arrayComisiones = DB::select('exec [usp_Comision_GetListarComision] ?, ?, ?, ?, ?, ?, ?, ?',
                                            [   $nIdEmpresa,
                                                $nIdSucursal,
                                                $nIdProveedor,
                                                $nIdConcepto,
                                                $nIdTurno,
                                                $cFlagComision,
                                                $cTipoComision,
                                                $cTipoMoneda
                                            ]);

        $arrayComisiones = ParametroController::arrayPaginator($arrayComisiones, $request);
        return ['arrayComisiones'=>$arrayComisiones];
    }

    public function SetRegistrarComision(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa             = $request->nIdEmpresa;
        $nIdSucursal            = $request->nIdSucursal;
        $nIdProveedor           = $request->nIdProveedor;
        $nIdConceptoComision    = $request->nIdConceptoComision;
        $nIdMoneda              = $request->nIdMoneda;
        $cFlagTurno             = $request->cFlagTurno;
        $nIdTurnoVendedor       = $request->nIdTurnoVendedor;
        $cFlagComisionVehiculo  = $request->cFlagComisionVehiculo;
        $cFlagElementoVenta     = $request->cFlagElementoVenta;
        $cFlagTipoComision      = $request->cFlagTipoComision;
        $fValorPorcentual       = $request->fValorPorcentual;
        $fValorMoneda           = $request->fValorMoneda;

        $cFlagTurno             = ($cFlagTurno) == null ? " " : $cFlagTurno;

        if($request->tipo == 1) {
            try{
                DB::beginTransaction();
                $arrayElementoVentaLength = sizeof($request->arrayData);
                if($arrayElementoVentaLength > 0){
                    $arrayElementoVenta = $request->arrayData;
                    foreach ($arrayElementoVenta as $key => $value) {
                        DB::select('exec usp_Comision_SetRegistrarComision ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $nIdProveedor,
                                        $nIdConceptoComision,
                                        $nIdMoneda,
                                        $cFlagTurno,
                                        $nIdTurnoVendedor,
                                        $cFlagComisionVehiculo,
                                        0,
                                        $cFlagElementoVenta,
                                        $value['nIdElemento'],
                                        $cFlagTipoComision,
                                        $fValorPorcentual,
                                        $fValorMoneda,
                                        Auth::user()->id
                                    ]);
                    }
                }
                DB::commit();
            } catch (Exception $e){
                DB::rollBack();
            }
        } else {
            try{
                DB::beginTransaction();
                $arrayLineaLength = sizeof($request->arrayData);
                if($arrayLineaLength > 0){
                    $arrayLinea = $request->arrayData;
                    foreach ($arrayLinea as $key => $value) {
                        DB::select('exec usp_Comision_SetRegistrarComision ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $nIdProveedor,
                                        $nIdConceptoComision,
                                        $nIdMoneda,
                                        $cFlagTurno,
                                        $nIdTurnoVendedor,
                                        $cFlagComisionVehiculo,
                                        $value['nIdLinea'],
                                        $cFlagElementoVenta,
                                        0,
                                        $cFlagTipoComision,
                                        $fValorPorcentual,
                                        $fValorMoneda,
                                        Auth::user()->id
                                    ]);
                    }
                }
                DB::commit();
            } catch (Exception $e){
                DB::rollBack();
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ObjComercialController extends Controller
{
    public function getCompraActiva(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $data = DB::select('exec usp_Cronog_GetCompraActivo');

        return response()->json($data);
    }

    public function getVentaActiva(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $data = DB::select('exec usp_Cronog_GetVentaActivo');

        return response()->json($data);
    }

    public function GetLstTipoBeneficio(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdGrupoPar = $request->nidgrupopar;
        $ctipobeneficionombre = $request->ctipobeneficionombre;
        $variable   = $request->opcion;

        $ctipobeneficionombre = ($ctipobeneficionombre == NULL) ? ($ctipobeneficionombre = ' ') : $ctipobeneficionombre;

        $parametro = DB::select('exec usp_TipoBeneficio_GetLstTipoBeneficio ?, ?, ?',
                                                            array($nIdEmpresa, $nIdGrupoPar, $ctipobeneficionombre));

        $parametro = ParametroController::arrayPaginator($parametro, $request);
        return ['arrayTipoIncentivo'=>$parametro];
    }

    public function GetDetalleVehiculoCompra(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCronograma = $request->nidcronograma;
        $nIdProveedor = $request->nidproveedor;
        $nIdLinea = $request->nidlinea;
        $nIdMarca = $request->nidmarca;
        $nIdModelo = $request->nidmodelo;

        $data = DB::select('exec usp_ObjComercial_GetDetalleVehiculoCompra ?, ?, ?, ?, ?, ?, ?',
                                                             [  $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdCronograma,
                                                                $nIdProveedor,
                                                                $nIdLinea,
                                                                $nIdMarca,
                                                                $nIdModelo
                                                             ]);
        return response()->json($data);
    }

    public function SetRegistrarObjComercialCompra(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->arrayData;

            foreach($detalles as $key => $det){
                if($det['nCantidadVehiculo'] > 0){                    
                    DB::select('exec usp_ObjComercial_SetRegistrarCompra ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                            [
                                $request->nIdEmpresa,
                                $request->nIdSucursal,
                                $request->nIdProveedor,
                                $request->nIdCronograma,
                                $request->cFlagTipoOperacion,
                                $det['nIdVersionVeh'],
                                $det['nCantidadVehiculo'],
                                $det['nIdFlagTipoBeneficio'],
                                $det['nIdFlagTipoValor'],
                                $det['fValorBeneficio'],
                                Auth::user()->id
                            ]);
                }
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetDetalleVehiculoVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCronograma = $request->nidcronograma;
        $nIdProveedor = $request->nidproveedor;
        $nIdLinea = $request->nidlinea;
        $nIdMarca = $request->nidmarca;
        $nIdModelo = $request->nidmodelo;

        $data = DB::select('exec usp_ObjComercial_GetDetalleVehiculoVenta ?, ?, ?, ?, ?, ?, ?',
                                                             [  $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdCronograma,
                                                                $nIdProveedor,
                                                                $nIdLinea,
                                                                $nIdMarca,
                                                                $nIdModelo
                                                             ]);
        return response()->json($data);
    }

    public function SetRegistrarObjComercialVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->arrayData;

            foreach($detalles as $key => $det){
                if($det['nCantidadVehiculo'] > 0){                    
                    DB::select('exec usp_ObjComercial_SetRegistrarVenta ?, ?, ?, ?, ?, ?, ?, ?',
                            [
                                $request->nIdEmpresa,
                                $request->nIdSucursal,
                                $request->nIdProveedor,
                                $request->nIdCronograma,
                                $request->cFlagTipoOperacion,
                                $det['nIdVersionVeh'],
                                $det['nCantidadVehiculo'],
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

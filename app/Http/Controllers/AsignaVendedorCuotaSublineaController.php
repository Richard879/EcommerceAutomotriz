<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AsignaVendedorCuotaSublineaController extends Controller
{
    public function GetLstVendedorSubLineaCuota(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     = $request->nidempresa;
        $nIdSucursal    = $request->nidsucursal;
        $nIdCronograma  = $request->nidcronograma;
        $nIdProveedor   = $request->nidproveedor;
        $nIdLinea       = $request->nidlinea;
        $nIdSubLinea    = $request->nidsublinea;
        $nIdJefeVentas  = $request->nidjefeventas;

        $nIdSubLinea = ($nIdSubLinea == NULL) ? ($nIdSubLinea = 0) : $nIdSubLinea;

        $arrayVendedorCuota = DB::select('exec [usp_AsignaCuotaVendedorSubLinea_GetListVendedoresCuota] ?, ?, ?, ?, ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdCronograma,
                                                                $nIdProveedor,
                                                                $nIdLinea,
                                                                $nIdSubLinea,
                                                                $nIdJefeVentas
                                                            ]);

        //$arrayVendedorCuota = ParametroController::arrayPaginator($arrayVendedorCuota, $request);
        return ['arrayVendedorCuota'=>$arrayVendedorCuota];
    }

    public function SetRegistraAsignacionCuota(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidempresa  = $request->nidempresa;
        $nidsucursal  = $request->nidsucursal;
        $nidcronograma  = $request->nidcronograma;
        $arrayFlagVendedoresByIdJV  = $request->arrayFlagVendedoresByIdJV;

        try {
            DB::beginTransaction();

            $arrayFlagVendedoreBsyIdJVLength = sizeof($arrayFlagVendedoresByIdJV);

            if($arrayFlagVendedoreBsyIdJVLength > 0) {
                foreach ($arrayFlagVendedoresByIdJV as $key => $value) {
                    if ($value['cNroCuota'] > 0) {
                        DB::select('exec [usp_AsignaCuotaVendedorSubLinea_SetAsignaCuota] ?, ?, ?, ?, ?, ?',
                                    [
                                        $nidempresa,
                                        $nidsucursal,
                                        $nidcronograma,
                                        $value['nIdAsignacionVendedorSubLinea'],
                                        $value['cNroCuota'],
                                        Auth::user()->id
                                    ]);
                    }
                }
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}

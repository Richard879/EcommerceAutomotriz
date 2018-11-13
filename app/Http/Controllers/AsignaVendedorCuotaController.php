<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class AsignaVendedorCuotaController extends Controller
{
    public function GetLstVendedorCuota(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     = $request->nidempresa;
        $nIdSucursal    = $request->nidsucursal;
        $nIdCronograma  = $request->nidcronograma;
        $nIdProveedor   = $request->nidproveedor;
        $nIdLinea       = $request->nidlinea;
        $nIdJefeVentas  = $request->nidjefeventas;

        $arrayVendedorCuota = DB::select('exec [usp_AsigVendedorCuota_GetListVendedoresCuota] ?, ?, ?, ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdCronograma,
                                                                $nIdProveedor,
                                                                $nIdLinea,
                                                                $nIdJefeVentas
                                                            ]);

        return response()->json($arrayVendedorCuota);
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
                        DB::select('exec usp_AsigVendedorCuota_SetAsignaVendedorCuota ?, ?, ?, ?, ?, ?',
                                    [
                                        $nidempresa,
                                        $nidsucursal,
                                        $nidcronograma,
                                        $value['nIdAsignacionVendedorModelo'],
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

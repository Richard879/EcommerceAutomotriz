<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AsignaVendedorSubLineaController extends Controller
{
    public function GetLstVendedorSubLinea(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdProveedor = $request->nidproveedor;
        $nIdLinea = $request->nidlinea;
        $nIdSubLinea = $request->nidsublinea;
        $nIdJefeVentas = $request->nidjefeventas;

        $nIdLinea = ($nIdLinea == NULL) ? ($nIdLinea = 0) : $nIdLinea;
        $nIdSubLinea = ($nIdSubLinea == NULL) ? ($nIdSubLinea = 0) : $nIdSubLinea;

        $arrayVendedorSubLinea = DB::select('exec [usp_AsignaVendedorSubLinea_GetListAsignaciones] ?, ?, ?, ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdProveedor, 
                                                                $nIdLinea,
                                                                $nIdSubLinea,
                                                                $nIdJefeVentas
                                                            ]);

        $arrayVendedorSubLinea = ParametroController::arrayPaginator($arrayVendedorSubLinea, $request);
        return ['arrayVendedorSubLinea'=>$arrayVendedorSubLinea];
    }

    public function SetAsignaSubLinea(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $vendedorlinea = DB::select('exec [usp_AsignaVendedorSubLinea_SetAsigna] ?, ?, ?, ?, ?, ?, ?',
                                                                [   $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdProveedor,
                                                                    $request->nIdVendedor,
                                                                    $request->nIdLinea,
                                                                    $request->nIdSubLinea,
                                                                    Auth::user()->id
                                                                ]);
        return response()->json($vendedorlinea);
    }

    public function SetDesasignaSubLinea(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $vendedorlinea = DB::select('exec [usp_AsignaVendedorSubLinea_SetDesasigna] ?, ?',
                                                            [   $request->nIdAsignacion,
                                                                Auth::user()->id
                                                            ]);
        return response()->json($vendedorlinea);
    }
}

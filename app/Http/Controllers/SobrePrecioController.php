<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SobrePrecioController extends Controller
{
    public function GetListModelos(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     = $request->nidempresa;
        $nIdSucursal    = $request->nidsucursal;
        $nIdProveedor   = $request->nidproveedor;
        $nIdLinea       = $request->nidlinea;
        $nIdMarca       = $request->nidmarca;
        $nIdModelo      = $request->nidmodelo;

        $nIdProveedor   = ($nIdProveedor == NULL) ? ($nIdProveedor = 0) : $nIdProveedor;
        $nIdLinea       = ($nIdLinea == NULL) ? ($nIdLinea = 0) : $nIdLinea;
        $nIdMarca       = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo      = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;

        $arrayModelos = DB::select('exec usp_AsigSobrePrecioByModelo_GetListModelo ?, ?, ?, ?, ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdProveedor,
                                                                $nIdLinea,
                                                                $nIdMarca,
                                                                $nIdModelo,
                                                                Auth::user()->id
                                                            ]);

        $arrayModelos = ParametroController::arrayPaginator($arrayModelos, $request);
        return ['arrayModelos'=>$arrayModelos];
    }
}

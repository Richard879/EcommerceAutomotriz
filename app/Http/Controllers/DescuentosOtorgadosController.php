<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class DescuentosOtorgadosController extends Controller
{
    public function GetListDistribucionDesc(Request $request)
    {
        $nidsucursal            =   $request->nidsucursal;
        $nidvendedor            =   $request->nidvendedor;
        $nidcronograma          =   $request->nidcronograma;
        $nidestadocotizacion    =   $request->nidestadocotizacion;
        $fmontodescuento        =   $request->fmontodescuento;

        $nidsucursal            =   ($nidsucursal == NULL) ? ($nidsucursal = 0) : $nidsucursal;
        $nidvendedor            =   ($nidvendedor == NULL) ? ($nidvendedor = 0) : $nidvendedor;
        $nidcronograma          =   ($nidcronograma == NULL) ? ($nidcronograma = 0) : $nidcronograma;
        $nidestadocotizacion    =   ($nidestadocotizacion == NULL) ? ($nidestadocotizacion = 0) : $nidestadocotizacion;
        $fmontodescuento        =   ($fmontodescuento == NULL) ? ($fmontodescuento = 0) : $fmontodescuento;

        $opcion         =   $request->opcion;

        $data = DB::select('exec [usp_Reporte_GetDistribucionDesc] ?, ?, ?, ?, ?',
                                            [
                                                $nidsucursal,
                                                $nidvendedor,
                                                $nidcronograma,
                                                $nidestadocotizacion,
                                                $fmontodescuento
                                            ]);

        if ($opcion == 1) {
            return response()->json($data);
        } else {
            return ['arrayDistribucionDesc'=>$data];
        }
    }
}

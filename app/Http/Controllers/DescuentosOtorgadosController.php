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
        $nidempresa         =   $request->nidempresa;
        $nidsucursal        =   $request->nidsucursal;
        $nidvendedor        =   $request->nidvendedor;
        $nidcronograma      =   $request->nidcronograma;
        $nidestadopedido    =   $request->nidestadopedido;
        $fmontodescuento    =   $request->fmontodescuento;

        $nidempresa         =   ($nidempresa == NULL) ? ($nidempresa = 0) : $nidempresa;
        $nidsucursal        =   ($nidsucursal == NULL) ? ($nidsucursal = 0) : $nidsucursal;
        $nidvendedor        =   ($nidvendedor == NULL) ? ($nidvendedor = 0) : $nidvendedor;
        $nidcronograma      =   ($nidcronograma == NULL) ? ($nidcronograma = 0) : $nidcronograma;
        $nidestadopedido    =   ($nidestadopedido == NULL) ? ($nidestadopedido = 0) : $nidestadopedido;
        $fmontodescuento    =   ($fmontodescuento == NULL) ? ($fmontodescuento = 0) : $fmontodescuento;

        $opcion         =   $request->opcion;

        $data = DB::select('exec [usp_DescuentosOtorgados_GetDistribucionDesc] ?, ?, ?, ?, ?, ?',
                                            [
                                                $nidempresa,
                                                $nidsucursal,
                                                $nidvendedor,
                                                $nidcronograma,
                                                $nidestadopedido,
                                                $fmontodescuento
                                            ]);

        if ($opcion == 1) {
            return response()->json($data);
        } else {
            return ['arrayDistribucionDesc'=>$data];
        }
    }
}

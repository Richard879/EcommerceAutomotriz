<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class TramiteController extends Controller
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

    public function GetPedidosCanceladosByEstadoTramite(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEstadoTramite   = $request->nIdEstadoTramite;
        $nIdTramitador      = Auth::user()->id;

        $nIdEstadoTramite = ($nIdEstadoTramite == NULL) ? ($nIdEstadoTramite = 0) : $nIdEstadoTramite;

        $arrayPedidosCancelados = DB::select('exec usp_Tramite_GetPedidosCanceladosByEstadoTramite ?, ?',
                                                            [
                                                                $nIdEstadoTramite,
                                                                $nIdTramitador
                                                            ]);

        $arrayPedidosCancelados = $this->arrayPaginator($arrayPedidosCancelados, $request);
        return ['arrayPedidosCancelados'=>$arrayPedidosCancelados];
    }
}

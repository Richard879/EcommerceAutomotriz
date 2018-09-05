<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class SolicitudCartaCaracteristica extends Controller
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

    public function GeLstCompras(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa  = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $cNumeroVin  = $request->cnumberovin;
        $cNumeroVin  = ($cNumeroVin == NULL) ? ($cNumeroVin = ' ') : $cNumeroVin;

        $arrayCompra = DB::select('exec usp_CartaCaracteristica_GetListCompras ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $cNumeroVin
                                                            ]);

        $arrayCompra = $this->arrayPaginator($arrayCompra, $request);
        return ['arrayCompra'=>$arrayCompra];
    }

    public function GetListContactos(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCronograma = $request->nidcronograma;
        $nTipoPersona = $request->ntipopersona;
        $cNroDocumento = $request->cnrodocumento;
        $cFiltroDescripcion = $request->cfiltrodescripcion;

        $cNroDocumento = ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cFiltroDescripcion = ($cFiltroDescripcion == NULL) ? ($cFiltroDescripcion = ' ') : $cFiltroDescripcion;

        $arrayContacto = DB::select('exec usp_Contacto_GetListContactoBySinCarteraMes ?, ?, ?, ?, ?, ?, ?',
                                                                                [
                                                                                    $nIdEmpresa,
                                                                                    $nIdSucursal,
                                                                                    $nIdCronograma,
                                                                                    $nTipoPersona,
                                                                                    $cNroDocumento,
                                                                                    $cFiltroDescripcion,
                                                                                    Auth::user()->id
                                                                                ]);

        $arrayContacto = $this->arrayPaginator($arrayContacto, $request);
        return ['arrayContacto'=>$arrayContacto];
    }

    public function SetRegistrarSCC(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $data = DB::select('exec usp_CartaCaracteristica_SetRegistrarSCC ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $request->cNumeroCarta,
                                        $request->cAtencion,
                                        $request->nIdRef,
                                        $request->dFechaInicio,
                                        $request->dFechaVencimiento,
                                        $request->nIdCompra,
                                        $request->nIdContacto,
                                        $request->fPrecioFinalDolar,
                                        $request->fCuotaInicial,
                                        $request->fMontoDesembolsado,
                                        $request->nIdBanco,
                                        $request->nIdEstadoCarta,
                                        $request->FlagEstadoApro,
                                        Auth::user()->id
                                    ]);

        return response()->json($data);
    }
}

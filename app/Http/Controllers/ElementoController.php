<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Elemento;

class ElementoController extends Controller
{
    public function GetElementoByTipo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa   = $request->nidempresa;
        $nIdTipoElemento = $request->nidtipoelemen;

        /*$data = $this->paginateArray($element = DB::select('exec usp_Elemen_GetElementoByTipo ?, ?', 
                                                    array($nIdEmpresa, $nIdTipoElemento)));*/
        
        $arrayElementoVenta = DB::select('exec usp_Elemen_GetElementoByTipo ?, ?', 
                                 array($nIdEmpresa, $nIdTipoElemento));

        $arrayElementoVenta = $this->arrayPaginator($arrayElementoVenta, $request);

        /*return ['pagination'=>[
                'total'        => $pagination->total(),
                'current_page' => $pagination->currentPage(),
                'per_page'     => $pagination->perPage(),
                'last_page'    => $pagination->lastPage(),
                'from'         => $pagination->firstItem(),
                'to'           => $pagination->lastItem(),
         ],'elementos'=>$element];*/

         return ['arrayElementoVenta'=>$arrayElementoVenta];
    }

    public function arrayPaginator($array, $request)
    {
        $page = $request->page;
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        $array = new Collection($array);
        $result = $array->forPage($page, $perPage)->values()->all();
        return  new LengthAwarePaginator($result, $array->count(), $perPage,$page);
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $element = DB::select('exec usp_Elemen_SetElemento ?, ?, ? ,? ,?, ?, ?, ?, ?', 
                                                            array($request->nIdEmpresa,
                                                                    $request->nIdProveedor,
                                                                    $request->nIdTipoElemento, 
                                                                    $request->nIdMoneda,
                                                                    $request->cElemenNombre,
                                                                    $request->fElemenValorVenta,
                                                                    $request->fElemenValorMinimoVenta,
                                                                    $request->cCodigoERP,
                                                                    Auth::user()->id
                                                                    ));
        return response()->json($element);         
    }

    public function desactivar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $elementoVenta = DB::select('exec usp_Element_DesactivaById ?', 
                                                            array(  $request->nIdElementoVenta
                                                                    ));
        return response()->json($elementoVenta);   
    }

    public function activar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $elementoVenta = DB::select('exec usp_Element_ActivaById ?', 
                                                            array(  $request->nIdElementoVenta
                                                                    ));
        return response()->json($elementoVenta);   
    }
    
}

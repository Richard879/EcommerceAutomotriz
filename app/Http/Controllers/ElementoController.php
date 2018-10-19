<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Elemento;

class ElementoController extends Controller
{
    public function GetElementoByTipo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa   = $request->nidempresa;
        $nIdTipoElemento = $request->nidtipoelemen;
        $cElemenNombre = $request->celementonombre;
        $nIdTipoElemento = ($nIdTipoElemento == NULL) ? ($nIdTipoElemento = 0) : $nIdTipoElemento;
        $cElemenNombre = ($cElemenNombre == NULL) ? ($cElemenNombre = '') : $cElemenNombre;
                
        $arrayElementoVenta = DB::select('exec [usp_Elemen_GetElementoByTipo] ?, ?, ?', 
                                                                [   $nIdEmpresa, 
                                                                    $nIdTipoElemento, 
                                                                    $cElemenNombre
                                                                ]);

        $arrayElementoVenta = ParametroController::arrayPaginator($arrayElementoVenta, $request);
        return ['arrayElementoVenta'=>$arrayElementoVenta];

        /*$data = $this->paginateArray($element = DB::select('exec usp_Elemen_GetElementoByTipo ?, ?', 
                                                    array($nIdEmpresa, $nIdTipoElemento)));*/

        /*return ['pagination'=>[
                'total'        => $pagination->total(),
                'current_page' => $pagination->currentPage(),
                'per_page'     => $pagination->perPage(),
                'last_page'    => $pagination->lastPage(),
                'from'         => $pagination->firstItem(),
                'to'           => $pagination->lastItem(),
         ],'elementos'=>$element];*/   
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $element = DB::select('exec [usp_Elemen_SetElemento] ?, ?, ? ,? ,?, ?, ?, ?, ?, ?', 
                                                            [   $request->nIdEmpresa,
                                                                $request->nIdProveedor,
                                                                $request->nIdTipoElemento, 
                                                                $request->nIdMoneda,
                                                                $request->cElemenNombre,
                                                                $request->fElemenValorVenta,
                                                                $request->fElemenValorMinimoVenta,
                                                                $request->cCodigoERP,
                                                                $request->fElemenValorCosto,
                                                                Auth::user()->id
                                                            ]);
        return response()->json($element);         
    }

    public function desactivar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $elementoVenta = DB::select('exec [usp_Element_DesactivaById] ?, ?', 
                                                    [   $request->nIdElementoVenta,
                                                    Auth::user()->id
                                                    ]);
        return response()->json($elementoVenta);   
    }

    public function activar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $elementoVenta = DB::select('exec [usp_Element_ActivaById] ?, ?', 
                                                        [   $request->nIdElementoVenta,
                                                            Auth::user()->id
                                                        ]);
        return response()->json($elementoVenta);   
    }
    
    public function UpdElementoById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $element = DB::select('exec [usp_Elemen_UpdElementoById] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', 
                                                            [   $request->nIdEmpresa,
                                                                $request->nIdProveedor,
                                                                $request->nIdElementoVenta,
                                                                $request->nIdTipoElemento, 
                                                                $request->nIdMoneda,
                                                                $request->cElemenNombre,
                                                                $request->fElemenValorVenta,
                                                                $request->fElemenValorMinimoVenta,
                                                                $request->cCodigoERP,
                                                                $request->fElemenValorCosto,
                                                                Auth::user()->id
                                                            ]);
        return response()->json($element);         
    }
}

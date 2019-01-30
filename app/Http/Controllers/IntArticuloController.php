<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IntArticuloController extends Controller
{
    public function SetIntegraArticulo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objArticulo = DB::select('exec [usp_Integra_SetIntegraArticulo] ?, ?, ?',
                                                            [   $det['cItemCode'],
                                                                $det['cLogRespuesta'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($objArticulo);
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}

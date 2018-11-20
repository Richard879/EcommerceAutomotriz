<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AsigVendedorTurnoController extends Controller
{
    public function GetParametroById(Request $request)
    {
        $nIdPar = $request->nidpar;
        $nIdGrupoPar = $request->nidgrupopar;

        $data = DB::select('exec usp_Par_GetParametroById ?, ?',  [$nIdPar, $nIdGrupoPar]);

        return response()->json($data);
    }

    public function GetParametroByParParent(Request $request)
    {
        $nidpar = $request->nidpar;
        $nidgrupar = $request->nidgrupar;
        $opcionPaginate = $request->opcionPaginate;

        $arrayVendedoresByIdJV = DB::select('exec usp_Par_GetParametroByParParent ?,?',  [$nidpar, $nidgrupar]);

        if($opcionPaginate == 1) {
            $arrayVendedoresByIdJV = ParametroController::arrayPaginator($arrayVendedoresByIdJV, $request);
            return ['arrayVendedoresByIdJV'=>$arrayVendedoresByIdJV];
        } else {
            return response()->json($arrayVendedoresByIdJV);
        }
    }

    public function GeLstDetalleTurno(Request $request)
    {
        $nidturno = $request->nidturno;

        $data = DB::select('exec [usp_AsignaVendedorTurno_GeLstDetalleTurno] ?',  [$nidturno]);

        return response()->json($data);
    }

    public function SetRegistrarVendedorTurno(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa             = $request->nidempresa;
        $nIdSucursal            = $request->nidsucursal;
        $nIdCronograma          = $request->nidcronograma;
        $nidvendedor            = $request->nidvendedor;
        $nidturnovendedor       = $request->nidturnovendedor;
        $data                   = $request->arrayData;

        try{
            DB::beginTransaction();
            $arrayFechaTurnoLength = sizeof($data);
            if($arrayFechaTurnoLength > 0){
                foreach ($data as $key => $value) {
                    DB::select('exec [usp_AsignaVendedorTurno_SetRegistrar] ?, ?, ?, ?, ?, ?, ?',
                            [
                                $nIdEmpresa,
                                $nIdSucursal,
                                $nIdCronograma,
                                $nidvendedor,
                                $nidturnovendedor,
                                $value['cdia'],
                                Auth::user()->id
                            ]);
                }
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}

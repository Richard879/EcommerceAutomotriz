<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class AsigVendedorTurno extends Controller
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

    public function GetParametroById(Request $request)
    {
        $nidpar = $request->nidpar;

        $data = DB::select('exec usp_Par_GetParametroById ?',  [$nidpar]);

        return response()->json($data);
    }

    public function GetParametroByParParent(Request $request)
    {
        $nidpar = $request->nidpar;
        $nidgrupar = $request->nidgrupar;

        $arrayVendedoresByIdJV = DB::select('exec usp_Par_GetParametroByParParent ?,?',  [$nidpar, $nidgrupar]);

        $arrayVendedoresByIdJV = $this->arrayPaginator($arrayVendedoresByIdJV, $request);
        return ['arrayVendedoresByIdJV'=>$arrayVendedoresByIdJV];
    }

    public function GeLstDetalleTurno(Request $request)
    {
        $nidturno = $request->nidturno;

        $data = DB::select('exec usp_TurnoVendedor_GeLstDetalleTurno ?',  [$nidturno]);

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
                    DB::select('exec usp_TurnoVendedor_SetRegistrar ?, ?, ?, ?, ?, ?, ?',
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

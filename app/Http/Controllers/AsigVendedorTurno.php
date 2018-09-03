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

        $arrayVendedoresByIdJV = DB::select('exec usp_Par_GetParametroByParParent ?',  [$nidpar]);

        $arrayVendedoresByIdJV = $this->arrayPaginator($arrayVendedoresByIdJV, $request);
        return ['arrayVendedoresByIdJV'=>$arrayVendedoresByIdJV];
    }
}

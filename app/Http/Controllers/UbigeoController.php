<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UbigeoController extends Controller
{
    public function GetDptos()
    {
        $dptos = DB::select('exec usp_Ubi_GetDptos');
        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' =>'SELECCIONE',
        ];
        foreach ($dptos as $key => $value) {
           $data[$key+1] =[
                'id'   => $value->cUbiGeoCodigo,
                'text' => $value->cUbiGeoDescripcion,
            ];
        }
        return response()->json($data);
    }

    public function GetProvinciasByDpto(Request $request)
    {
        $cUbiDptoCodigo = $request->niddepartamento;

        $prov = DB::select('exec usp_Ubi_GetProvinciasByDpto ?', array($cUbiDptoCodigo));
        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' =>'SELECCIONE',
        ];
        foreach ($prov as $key => $value) {
           $data[$key+1] =[
                'id'   => $value->cPrvCodigo,
                'text' => $value->cPrvDescripcion,
            ];
        }
        return response()->json($data);
    }

    public function GetDistritosByProv(Request $request)
    {
        $cUbiProvCodigo = $request->nidprovincia;

        $prov = DB::select('exec usp_Ubi_GetDistritosByProv ?', [$cUbiProvCodigo]);
        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' =>'SELECCIONE',
        ];
        foreach ($prov as $key => $value) {
           $data[$key+1] =[
                'id'   => $value->cDisCodigo,
                'text' => $value->cDisDescripcion,
            ];
        }
        return response()->json($data);
    }
}

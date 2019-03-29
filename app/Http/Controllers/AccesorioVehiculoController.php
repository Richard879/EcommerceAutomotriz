<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AccesorioVehiculoController extends Controller
{
    public function GetListVehiculos(Request $request)
    {
        $nIdEmpresa         = $request->nIdEmpresa;
        $nIdProveedor       = $request->nIdProveedor;
        $nIdLinea           = $request->nIdLinea;
        $nIdMarca           = $request->nIdMarca;
        $nIdModelo          = $request->nIdModelo;
        $cNombreVehiculo    = $request->cNombreVehiculo;

        $nIdEmpresa         = ($nIdEmpresa == NULL) ? ($nIdEmpresa = 0) : $nIdEmpresa;
        $nIdProveedor       = ($nIdProveedor == NULL) ? ($nIdProveedor = 0) : $nIdProveedor;
        $nIdLinea           = ($nIdLinea == NULL) ? ($nIdLinea = 0) : $nIdLinea;
        $nIdMarca           = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo          = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdMarca;
        $cNombreVehiculo    = ($cNombreVehiculo == NULL) ? ($cNombreVehiculo = '') : $cNombreVehiculo;

        $data = DB::select('exec [usp_AccesorioVehiculo_GetListVehiculos] ?, ?, ?, ?, ?, ?',
                                                [   $nIdEmpresa,
                                                    $nIdProveedor,
                                                    $nIdLinea,
                                                    $nIdMarca,
                                                    $nIdModelo,
                                                    $cNombreVehiculo
                                                ]);

        $arrayListVehiculos = ParametroController::arrayPaginator($data, $request);
        return ['arrayListVehiculos'=>$arrayListVehiculos];
    }

    public function GetListElemetosByVehiculo(Request $request)
    {
        $nIdEmpresa     =   $request->nidempresa;
        $nIdVersionVeh  =   $request->nIdVersionVeh;
        // $cNombreVehiculo    = $request->cnombrevehiculo;

        $data = DB::select('exec [usp_AccesorioVehiculo_GetListElementos] ?, ?',
                                                        [
                                                            $nIdEmpresa,
                                                            $nIdVersionVeh
                                                        ]);
        return response()->json($data);
    }

    public function DeleteElementosByVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $element = DB::select('exec [usp_AccesorioVehiculo_SetDeleteElementoVentaByVehiculo] ?, ?, ?',
                                                            [
                                                                $request->nIdEmpresa,
                                                                $request->nidversion,
                                                                Auth::user()->id
                                                            ]);
        return response()->json($element);
    }

    public function SetElementosByVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->arrayData;
            foreach($detalles as $ep=>$det)
            {
                DB::select('exec [usp_AccesorioVehiculo_SetElementosByVehiculo] ?, ?, ?, ?, ?',
                                                            [
                                                                $request->nIdEmpresa,
                                                                $request->nidversion,
                                                                $det['nIdElemento'],
                                                                $det['cantidad'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetListAccesoriosByVehiculo(Request $request)
    {
        $nIdEmpresa     = $request->nIdEmpresa;
        $nIdVersionVeh  = $request->nIdVersionVeh;
        // $cNombreVehiculo    = $request->cnombrevehiculo;

        $data = DB::select('exec [usp_AccesorioVehiculo_GetListElementosByVehiculo] ?, ?',
                                                        [
                                                            $nIdEmpresa,
                                                            $nIdVersionVeh
                                                        ]);
        return response()->json($data);
    }
}

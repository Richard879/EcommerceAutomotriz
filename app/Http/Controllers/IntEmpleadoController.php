<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IntEmpleadoController extends Controller
{
    public function SetIntegraEmpleado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->arraySapUpdVendedor;
            foreach($detalles as $ep=>$det)
            {
                $data = DB::select('exec [usp_Integra_SetIntegraVendedor] ?, ?, ?, ?',
                                                            [
                                                                $det['nUsuario'],
                                                                $det['SalesEmployeeCode'],
                                                                $det['cLogRespuesta'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($data);
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}

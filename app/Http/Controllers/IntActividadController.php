<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IntActividadController extends Controller
{
    public function SetIntegraActividad(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objProyecto = DB::select('exec [usp_Integra_SetIntegraActividadByServiceCall] ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $det['nServiceCallID'],
                                                                $det['nActivityCode'],
                                                                $det['nActividadTipo'],
                                                                $det['cActividadTipo'],
                                                                $det['cCardCode'],
                                                                $det['nDocEntry'],
                                                                $det['nDocNum'],
                                                                $det['cLogRespuesta'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($objProyecto);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetIntegraActividadCompra(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objProyecto = DB::select('exec [usp_Integra_SetIntegraActividad] ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $det['nActivityCode'],
                                                                $det['nActividadTipo'],
                                                                $det['cActividadTipo'],
                                                                $det['cCardCode'],
                                                                $det['nDocEntry'],
                                                                $det['nDocNum'],
                                                                $det['cLogRespuesta'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($objProyecto);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetIntegraActividadVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            // ======================================================================
            // GUARDAR ACTIVIDAD DE LA ORDEN DE VENTA PARA VEHÍCULO EN SQL SERVER
            // ======================================================================
            $arraySapUpdSgcVehiculoLength = sizeof($request->arraySapUpdSgcVehiculo);
            if($arraySapUpdSgcVehiculoLength > 0) {
                $arraySapUpdSgcVehiculo = $request->arraySapUpdSgcVehiculo;
                foreach($arraySapUpdSgcVehiculo as $ep=>$det)
                {
                    $objProyecto = DB::select('exec [usp_Integra_SetIntegraActividad] ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $det['nActivityCode'],
                                                                    $det['nActividadTipo'],
                                                                    $det['cActividadTipo'],
                                                                    $det['cCardCode'],
                                                                    $det['nDocEntry'],
                                                                    $det['nDocNum'],
                                                                    $det['cLogRespuesta'],
                                                                    Auth::user()->id
                                                                ]);
                }
            }

            // ======================================================================
            // GUARDAR ACTIVIDAD DE LA ORDEN DE VENTA PARA ELEMENTO VENTA EN SQL SERVER
            // ======================================================================
            $arraySapUpdSgcEVLength = sizeof($request->arraySapUpdSgcEV);
            if($arraySapUpdSgcEVLength > 0) {
                $arraySapUpdSgcEV = $request->arraySapUpdSgcEV;
                foreach($arraySapUpdSgcEV as $ep=>$det)
                {
                    $objProyecto = DB::select('exec [usp_Integra_SetIntegraActividad] ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $det['nActivityCode'],
                                                                    $det['nActividadTipo'],
                                                                    $det['cActividadTipo'],
                                                                    $det['cCardCode'],
                                                                    $det['nDocEntry'],
                                                                    $det['nDocNum'],
                                                                    $det['cLogRespuesta'],
                                                                    Auth::user()->id
                                                                ]);
                }
            }

            DB::commit();
            return response()->json($objProyecto);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetIntegraActividadByItemCode(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $cItemCode      =  $request->citemcode;
        $nActividadTipo =  $request->nactividadtipo;

        $arrayActividad = DB::select('exec [usp_Integra_GetIntegraActividadByItemCode] ?, ?',
                                            [   $cItemCode,
                                                $nActividadTipo
                                            ]);

        return response()->json($arrayActividad);
    }

    public function GetIntegraActividadVentaByItemCode(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        // $cItemCode      =  $request->citemcode;
        $nActividadTipo =   $request->nactividadtipo;

        // ======================================================================
        // OBTENER INFORMACIÓN DE LA ACTIVIDAD DEL VEHÍCULO PARA LLAMADA SERVICIOS
        // ======================================================================
        $arrayInfoVehiculoActividad = [];
        $arrayVINPedidoVehiculoLength = sizeof($request->arrayVINPedidoVehiculo);
        if($arrayVINPedidoVehiculoLength > 0) {
            $data = $request->arrayVINPedidoVehiculo;
            foreach($data as $key => $value)
            {
                $arrayVehiculoActividad = DB::select('exec [usp_Integra_GetIntegraActividadVentaByItemCode] ?, ?, ?',
                                                    [   $value['nDocEntry'],
                                                        $value['cItemCode'],
                                                        $nActividadTipo
                                                    ]);

                array_push($arrayInfoVehiculoActividad, $arrayVehiculoActividad);
            }
        }

        // ======================================================================
        // OBTENER INFORMACIÓN DE LA ACTIVIDAD DEL E.V PARA LLAMADA SERVICIOS
        // ======================================================================
        $arrayInfoEVActividad = [];
        $arrayCodSAPPedidoEVLength = sizeof($request->arrayCodSAPPedidoEV);
        if($arrayCodSAPPedidoEVLength > 0) {
            $data = $request->arrayCodSAPPedidoEV;
            foreach($data as $key => $value)
            {
                $arrayEVActividad = DB::select('exec [usp_Integra_GetIntegraActividadVentaByItemCode] ?, ?, ?',
                                                    [   $value['nDocEntry'],
                                                        $value['cItemCode'],
                                                        $nActividadTipo
                                                    ]);

                array_push($arrayInfoEVActividad, $arrayEVActividad[0]);
            }
        }

        return [
            'arrayInfoVehiculoActividad'  =>  $arrayVehiculoActividad,
            'arrayInfoEVActividad'  =>  $arrayInfoEVActividad
        ];

        // return response()->json($arrayActividad);
    }
}

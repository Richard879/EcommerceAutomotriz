<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CotizacionController extends Controller
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

    public function GetListReferencias(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $variable = 0;

        $arrayReferencias = DB::select('exec usp_Cotizacion_GetListReferencias');

        $data = [];
        if($variable == "0"){
            $data[0] = [
                'nIdPar'   => 0,
                'cParNombre' =>'SELECCIONE',
            ];
        }
        foreach ($arrayReferencias as $key => $value) {
           $data[$key+1] =[
                'nIdPar'   => $value->nIdPar,
                'cParNombre' => $value->cParNombre,
            ];
        }

        return response()->json($data);
    }

    public function GetTipoLista(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $tipoLista = $request->nidtipolista;

        $arrayTipoLista = DB::select('exec usp_Cotizacion_GetListTipoLista ?', [$tipoLista]);

        return response()->json($arrayTipoLista);
    }

    public function GetListVehiculos(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidtipolista = $request->nidtipolista;
        $nidlinea   = $request->nidlinea;
        $nidmarca   = $request->nidmarca;
        $nidmodelo  = $request->nidmodelo;
        $cnombrecomercial = $request->cnombrecomercial;

        $nidlinea = ($nidlinea == 0) ? ($nidlinea = '') : $nidlinea;
        $nidmarca = ($nidmarca == 0) ? ($nidmarca = '') : $nidmarca;
        $nidmodelo = ($nidmodelo == 0) ? ($nidmodelo = '') : $nidmodelo;
        $cnombrecomercial = ($cnombrecomercial == "") ? ($cnombrecomercial = '') : $cnombrecomercial;

        $arrayListaVehiculos = DB::select('exec usp_Cotizacion_GetListVehiculos ?, ?, ?, ?, ?',
                                                                        array(  $nidtipolista,
                                                                                $nidlinea,
                                                                                $nidmarca,
                                                                                $nidmodelo,
                                                                                $cnombrecomercial
                                                                            ));

        $arrayListaVehiculos = $this->arrayPaginator($arrayListaVehiculos, $request);
        return ['arrayListaVehiculos'=>$arrayListaVehiculos];
    }

    public function GetTipoCambio(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tipocambio = DB::select('exec usp_Cotizacion_GetTipoCambio');
        return response()->json($tipocambio);
    }

    public function SetCabeceraCotizacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayCabeceraCotizacion = DB::select('exec usp_Cotizacion_SetCabeceraCotizacion ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    array(  $request->nIdAsignacionContactoVendedor,
                                            $request->cNumeroCotizacion,
                                            $request->nIdEmpresa,
                                            $request->nIdSucursal,
                                            $request->nIdReferencia,
                                            $request->dFechaCotizacion,
                                            $request->dFechaVencimientoCotizacion,
                                            $request->fTipoCambioVenta,
                                            $request->fTipoCambioCompra,
                                            $request->fTotalCotizacionVehiculoDolar,
                                            $request->fTotalCotizacionVehiculoSol,
                                            $request->fTotalElementoVentaDolar,
                                            $request->fTotalElementoVentaSol,
                                            Auth::user()->id
                                        ));

        return response()->json($arrayCabeceraCotizacion);
    }

    public function SetDetalleCotizacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            //Itera todas las referencias de vehiculos
            foreach($detalles as $ep=>$det)
            {
                DB::select('exec usp_Contacto_SetReferenciaVehiculo ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                        array(
                                                            $request->nIdEmpresa,
                                                            $request->nIdSucursal,
                                                            $request->nIdCronograma,
                                                            $request->nIdContacto,
                                                            $det['nIdProveedor'],
                                                            $det['nIdLinea'],
                                                            $det['nIdMarca'],
                                                            $det['nIdModelo'],
                                                            $det['nAnioFabricacion'],
                                                            $det['nAnioModelo'],
                                                            Auth::user()->id
                                                        ));
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}

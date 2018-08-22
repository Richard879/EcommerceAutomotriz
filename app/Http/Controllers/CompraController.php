<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Compra;

class CompraController extends Controller
{

    public function GetCompra(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $dFechaInicio = $request->dfechainicio;
        $dFechaFin = $request->dfechafin;
        $nOrdenCompra = $request->nordencompra;
        $cNumeroVin = $request->cnumerovin;
        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = ' ') : $cNumeroVin;

        $arrayCompra = DB::select('exec usp_Compra_GetCompra ?, ?, ?, ?, ?, ?',
                                                            array(  $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $dFechaInicio,
                                                                    $dFechaFin,
                                                                    $nOrdenCompra,
                                                                    $cNumeroVin
                                                                    ));

        $arrayCompra = $this->arrayPaginator($arrayCompra, $request);
        return ['arrayCompra'=>$arrayCompra];
    }

    public function arrayPaginator($array, $request)
    {
        $page = $request->page;
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        $array = new Collection($array);
        $result = $array->forPage($page, $perPage)->values()->all();
        return  new LengthAwarePaginator($result, $array->count(), $perPage,$page);
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                //$detalle = new Compra();
                //$detalle->nOrdenCompra = $det['nOrdenCompra'];
                //$detalle->cNombreLinea = $det['cNombreLinea'];
                //$detalle->save();

                //$fTotalCompra = preg_replace('/\D/', '', $det['fTotalCompra']);
                //$fTotalCompra = preg_replace("[^0-9]", '', $det['fTotalCompra']);
                $fTotalCompra = str_replace("$", "", $det['fTotalCompra']);
                $fTotalCompra = str_replace(",", "", $fTotalCompra);
                //echo $fTotalCompra. " ";

                DB::select('exec usp_Compra_SetCompra ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            array($request->nIdEmpresa,
                                                                $request->nIdSucursal,
                                                                $request->nIdCronograma,
                                                                $request->nIdProveedor,
                                                                $request->nIdTipoLista,
                                                                $det['nOrdenCompra'],
                                                                $det['cNombreLinea'],
                                                                $det['cNombreAlmacen'],
                                                                $det['nNumeroReserva'],
                                                                $det['cNumeroVin'],
                                                                $det['cFormaPago'],
                                                                $det['cNombreMarca'],
                                                                $det['cNombreModelo'],
                                                                $det['cNombreComercial'],
                                                                $det['cNombreColor'],
                                                                $det['cAnioFabricacion'],
                                                                $det['cAnioVersion'],
                                                                $det['cSimboloMoneda'],
                                                                $fTotalCompra,
                                                                $det['cNumeroFactura'],
                                                                $det['dFechaFacturado'],
                                                                Auth::user()->id
                                                            ));
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetCompraSinWOperativo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $cNumeroVin = $request->cnumerovin;
        $cNombreComercial = $request->cnombrecomercial;
        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = ' ') : $cNumeroVin;
        $cNombreComercial = ($cNombreComercial == NULL) ? ($cNombreComercial = ' ') : $cNombreComercial;

        $arrayVersionVehiculo = DB::select('exec usp_Compra_GetVehiculosSinWOperativo ?, ?, ?, ?',
                                                                        array(  $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $cNumeroVin,
                                                                                $cNombreComercial
                                                                                ));

        $arrayVersionVehiculo = $this->arrayPaginator($arrayVersionVehiculo, $request);
        return ['arrayVersionVehiculo'=>$arrayVersionVehiculo];
    }

    public function GetCompraSinWFinanciero(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $cNumeroVin = $request->cnumerovin;
        $cNombreComercial = $request->cnombrecomercial;
        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = ' ') : $cNumeroVin;
        $cNombreComercial = ($cNombreComercial == NULL) ? ($cNombreComercial = ' ') : $cNombreComercial;

        $arrayVersionVehiculo = DB::select('exec usp_Compra_GetVehiculosSinWFinanciero ?, ?, ?, ?',
                                                                        array(  $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $cNumeroVin,
                                                                                $cNombreComercial
                                                                                ));

        $arrayVersionVehiculo = $this->arrayPaginator($arrayVersionVehiculo, $request);
        return ['arrayVersionVehiculo'=>$arrayVersionVehiculo];
    }

    public function desactivar (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayCompra = DB::select('exec usp_Compra_DesactivaById ?',
                                                            array(  $request->nIdCompra
                                                                    ));
        return response()->json($arrayCompra);
    }
}

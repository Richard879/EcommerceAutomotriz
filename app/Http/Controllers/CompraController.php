<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Maatwebsite\Excel\Facades\Excel;
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
        $nIdMarca   = $request->nidmarca;
        $nIdModelo  = $request->nidmodelo;
        
        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = ' ') : $cNumeroVin;
        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;



        $arrayCompra = DB::select('exec [usp_Compra_GetCompra] ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $dFechaInicio,
                                                                $dFechaFin,
                                                                $nOrdenCompra,
                                                                $cNumeroVin,
                                                                $nIdMarca,
                                                                $nIdModelo
                                                            ]);

        $arrayCompra = Parametro::arrayPaginator($arrayCompra, $request);
        return ['arrayCompra'=>$arrayCompra];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;

            $arrayVinExiste = [];
            $arrayPrecioLista = [];

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

                $objCompra = DB::select('exec [usp_Compra_SetCompra] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $request->nIdEmpresa,
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
                                                                $det['nAnioFabricacion'],
                                                                $det['nAnioVersion'],
                                                                $det['cSimboloMoneda'],
                                                                $fTotalCompra,
                                                                $det['cNumeroFactura'],
                                                                $det['dFechaFacturado'],
                                                                Auth::user()->id
                                                            ]);
                if($objCompra[0]->nFlagMsje == 0){
                    array_push($arrayVinExiste,$objCompra[0]->cNumeroVin);
                }
                if($objCompra[0]->nFlagMsje == 2){
                    array_push($arrayPrecioLista,$objCompra[0]->cNumeroVin);
                }
            }
            $data = [
                'arrayVinExiste'=>$arrayVinExiste,
                'arrayPrecioLista'=>$arrayPrecioLista
            ];

            return response()->json($data);

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

        $arrayVersionVehiculo = DB::select('exec [usp_Compra_GetVehiculosSinWOperativo] ?, ?, ?, ?',
                                                                        [   $nIdEmpresa,
                                                                            $nIdSucursal,
                                                                            $cNumeroVin,
                                                                            $cNombreComercial
                                                                        ]);

        $arrayVersionVehiculo = ParametroController::arrayPaginator($arrayVersionVehiculo, $request);
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

        $arrayVersionVehiculo = DB::select('exec [usp_Compra_GetVehiculosSinWFinanciero] ?, ?, ?, ?',
                                                                        [   $nIdEmpresa,
                                                                            $nIdSucursal,
                                                                            $cNumeroVin,
                                                                            $cNombreComercial
                                                                        ]);

        $arrayVersionVehiculo = ParametroController::arrayPaginator($arrayVersionVehiculo, $request);
        return ['arrayVersionVehiculo'=>$arrayVersionVehiculo];
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayCompra = DB::select('exec [usp_Compra_DesactivaById] ?, ?',
                                                [   $request->nIdCompra,
                                                    Auth::user()->id
                                                ]);
        return response()->json($arrayCompra);
    }

    public function SetForum(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                DB::select('exec [usp_Compra_SetForum] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $det['cNombreModelo'],
                                                                $det['cNumeroVin'],
                                                                $det['cNumeroMotor'],
                                                                $det['cNombreColor'],
                                                                $det['dFechaFactura'],
                                                                $det['cNumeroFactura'],
                                                                $det['nNumeroPedido'],
                                                                $det['dFechaInicioFloorPlan'],
                                                                $det['dFechaVenceFloorPlan'],
                                                                $det['fMonto'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function UpdCompraById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $compra = DB::select('exec [usp_Compra_UpdCompraById] ?, ?, ?, ?, ?, ?, ?, ?',
                                                        [   $request->nIdEmpresa,
                                                            $request->nIdProveedor,
                                                            $request->nIdCompra,
                                                            $request->cNumeroVin,
                                                            $request->cNumeroMotor,
                                                            $request->cNumeroDua,
                                                            $request->cNombreColor,
                                                            Auth::user()->id
                                                        ]);
        return response()->json($compra);
    }

    public function GetLstCompraNoLineaCredito(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $dFechaInicio = $request->dfechainicio;
        $dFechaFin = $request->dfechafin;
        $nOrdenCompra = $request->nordencompra;
        $cNumeroVin = $request->cnumerovin;
        $nIdMarca   = $request->nidmarca;
        $nIdModelo  = $request->nidmodelo;
        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = ' ') : $cNumeroVin;

        $arrayLineaCredito = DB::select('exec [usp_Compra_GetLstCompraNoLineaCredito] ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $dFechaInicio,
                                                                    $dFechaFin,
                                                                    $nOrdenCompra,
                                                                    $cNumeroVin,
                                                                    $nIdMarca,
                                                                    $nIdModelo
                                                                ]);

        $arrayLineaCredito = Parametro::arrayPaginator($arrayLineaCredito, $request);
        return ['arrayLineaCredito'=>$arrayLineaCredito];
    }

    public function UpdCompraLineaCreditoById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;

            foreach($detalles as $ep=>$det)
            {
                $objCompra = DB::select('exec [usp_Compra_UpdCompraLineaCreditoById] ?, ?, ?, ?, ?',
                                                            [   $request->nIdEmpresa,
                                                                $request->nIdSucursal,
                                                                $det['nIdCompra'],
                                                                $det['cNumeroVin'],
                                                                Auth::user()->id
                                                            ]);
            }
            //return response()->json($data);
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}

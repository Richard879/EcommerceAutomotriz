<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FleteController extends Controller
{
    public function GetListFlete(Request $request)
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
        
        $dFechaInicio = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
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

    public function SetFlete(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;

            /*$arrayVinExiste = [];
            $arrayPrecioLista = [];
            $arrayNombreComercial = [];*/

            foreach($detalles as $ep=>$det)
            {

                $objCompra = DB::select('exec [usp_Flete_SetFlete] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
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
                /*if($objCompra[0]->nFlagMsje == 0){
                    array_push($arrayVinExiste,$objCompra[0]->cNumeroVin);
                }
                if($objCompra[0]->nFlagMsje == 2){
                    array_push($arrayPrecioLista,$objCompra[0]->cNumeroVin);
                }
                if($objCompra[0]->nFlagMsje == 3){
                    array_push($arrayNombreComercial,$objCompra[0]->cNumeroVin);
                }*/
            }
            /*$data = [
                'arrayVinExiste'=>$arrayVinExiste,
                'arrayPrecioLista'=>$arrayPrecioLista,
                'arrayNombreComercial'=>$arrayNombreComercial
            ];*/
            DB::commit();
            //return response()->json($objCompra);
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}

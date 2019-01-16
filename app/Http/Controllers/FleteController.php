<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FleteController extends Controller
{
    public function GetComprasForFlete(Request $request)
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



        $arrayCompra = DB::select('exec [usp_Flete_GetComprasForFlete] ?, ?, ?, ?, ?, ?, ?, ?',
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

    public function GetListFlete(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $dFechaInicio = $request->dfechainicio;
        $dFechaFin = $request->dfechafin;
        $cNumeroVin = $request->cnumerovin;
        $nIdMarca   = $request->nidmarca;
        $nIdModelo  = $request->nidmodelo;
        
        $dFechaInicio = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = ' ') : $cNumeroVin;
        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;



        $arrayFlete = DB::select('exec [usp_Flete_GetListFlete] ?, ?, ?, ?, ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $dFechaInicio,
                                                                $dFechaFin,
                                                                $cNumeroVin,
                                                                $nIdMarca,
                                                                $nIdModelo
                                                            ]);

        $arrayFlete = Parametro::arrayPaginator($arrayFlete, $request);
        return ['arrayFlete'=>$arrayFlete];
    }

    public function SetFlete(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            /*$arrayVinExiste = [];
            $arrayPrecioLista = [];
            $arrayNombreComercial = [];*/
            $detalles = $request->data;

            $objFlete = DB::select('exec [usp_Flete_SetFlete] ?, ?, ?, ?, ?, ?, ?', 
                                                                [   $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->cNumeroRuc,
                                                                    $request->cTipoComprobante,
                                                                    $request->cSerieComprobante,
                                                                    $request->cNumeroComprobante,
                                                                    Auth::user()->id
                                                                ]);

            $nIdFlete =  $objFlete[0]->nIdFlete;
            
            foreach($detalles as $ep=>$det)
            {

                $bjFleteDetalle = DB::select('exec [usp_Flete_SetFleteDetalle] ?, ?, ?, ?, ?, ?',
                                                            [   $nIdFlete,
                                                                $det['nIdCompra'],
                                                                $det['cNumeroVin'],
                                                                $det['nIdMoneda'],
                                                                $det['fImporteFlete'],
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

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
        
        $dFechaInicio = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;

        $arrayFlete = DB::select('exec [usp_Flete_GetListFlete] ?, ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $dFechaInicio,
                                                                $dFechaFin
                                                            ]);

        $arrayFlete = Parametro::arrayPaginator($arrayFlete, $request);
        return ['arrayFlete'=>$arrayFlete];
    }

    public function GetListFleteDetalle(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdFlete = $request->nidflete;
        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $cNumeroVin = $request->cnumerovin;
        $nIdMarca   = $request->nidmarca;
        $nIdModelo  = $request->nidmodelo;
        
        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;
        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;

        $arrayFleteDetalle = DB::select('exec [usp_Flete_GetListFleteDetalle] ?, ?, ?, ?, ?, ?',
                                                            [   $nIdFlete,
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdMarca,
                                                                $nIdModelo,
                                                                $cNumeroVin
                                                            ]);

        $arrayFleteDetalle = Parametro::arrayPaginator($arrayFleteDetalle, $request);
        return ['arrayFleteDetalle'=>$arrayFleteDetalle];
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

    public function GetCompraTC(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     = $request->nIdEmpresa;
        $nIdSucursal    = $request->nIdSucursal;
        $nIdCronograma  = $request->nIdCronograma;

        $array_infoFlete            =   [];

        $data = $request->data;
        foreach ($data as $key => $value) {
            // ==================================================================================
            // =============================  FLETE =============================================
            $data = DB::select('exec [usp_TablaCosto_GetCompra_Flete] ?, ?, ?',
                                                    [   $nIdEmpresa,
                                                        $nIdSucursal,
                                                        $value['cNumeroVin']
                                                    ]);

            if ($data) {
                $flete = $data[0];
                $U_SYP_VIN          =   $flete->cNumeroVin;
                $U_SYP_CCONCEPTO    =   $flete->U_SYP_CCONCEPTO;
                $U_SYP_DCONCEPTO    =   $flete->U_SYP_DCONCEPTO;
                $U_SYP_CDOCUMENTO   =   $flete->U_SYP_CDOCUMENTO;
                $U_SYP_DDOCUMENTO   =   $flete->U_SYP_DDOCUMENTO;
                $U_SYP_IMPORTE      =   $flete->fImporteFleteSinIgv;
                $U_SYP_COSTO        =   $flete->U_SYP_COSTO;
                $U_SYP_ESTADO       =   $flete->U_SYP_ESTADO;

                $infoFlete = [
                    'U_SYP_VIN'         =>  $U_SYP_VIN,
                    'U_SYP_CCONCEPTO'   =>  $U_SYP_CCONCEPTO,
                    'U_SYP_DCONCEPTO'   =>  $U_SYP_DCONCEPTO,
                    'U_SYP_CDOCUMENTO'  =>  $U_SYP_CDOCUMENTO,
                    'U_SYP_DDOCUMENTO'  =>  $U_SYP_DDOCUMENTO,
                    'U_SYP_IMPORTE'     =>  $U_SYP_IMPORTE,
                    'U_SYP_COSTO'       =>  $U_SYP_COSTO,
                    'U_SYP_ESTADO'      =>  $U_SYP_ESTADO
                ];
                array_push($array_infoFlete, $infoFlete);
            }
        }

        $tblCostos = [
            'array_infoFlete'         =>  $array_infoFlete
        ];

        return response()->json($tblCostos);
    }

    // ====================================================================================================
            // ==========================  REGISTRAR DETALLE CABECERA TBL COST - FLETE ============================
            /*$arrayTCFlete = $request->arrayTCFlete;
            foreach ($arrayTCFlete as $key => $flete) {
                //Verifica que el VIN de ese Flete sea Igual al VIN de la Cabecera Costo, para que se le asigne al detalle como concepto
                if ($TblCostoVIN == $flete['U_SYP_VIN']) {
                    $json = [
                        'json' => [
                            "DocEntry"          => (string)$TblCostoDocEntry,
                            "U_SYP_CCONCEPTO"   => (string)$flete['U_SYP_CCONCEPTO'],
                            "U_SYP_DCONCEPTO"   => (string)$flete['U_SYP_DCONCEPTO'],
                            "U_SYP_CDOCUMENTO"  => (string)$flete['U_SYP_CDOCUMENTO'],
                            "U_SYP_DDOCUMENTO"  => (string)$flete['U_SYP_DDOCUMENTO'],
                            "U_SYP_IMPORTE"     => (string)$flete['U_SYP_IMPORTE'],
                            "U_SYP_COSTO"       => (string)$flete['U_SYP_COSTO'],
                            "U_SYP_ESTADO"      => (string)$flete['U_SYP_ESTADO']
                        ]
                    ];

                    $rptaFlete = $client->request('POST', "/api/TblCosto/SapPachTblCostoDet/", $json);
                    $rptaSapFlete = json_decode($rptaFlete->getBody());
                    array_push($array_rptaFlete, $rptaSapFlete);
                }
            }*/

            /*$rpta = [
                'array_rptaBeneficio'       =>  $array_rptaBeneficio,
                'array_rptaCostoVehiculo'   =>  $array_rptaCostoVehiculo,
                'array_rptaFlete'           =>  $array_rptaFlete
            ];*/
}

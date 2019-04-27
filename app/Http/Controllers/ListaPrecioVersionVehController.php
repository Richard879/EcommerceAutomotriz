<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\ListaPrecioVersionVeh;

class ListaPrecioVersionVehController extends Controller
{
    public function GetListaVh(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     = $request->nidempresa;
        $nIdSucursal    = $request->nidsucursal;
        $dFechaInicio   = $request->dfechainicio;
        $dFechaFin      = $request->dfechafin;
        $nIdProveedor   = $request->nidproveedor;

        $dFechaInicio   = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin      = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;

        $arrayListaPrecioVh = DB::select('exec [usp_ListaPrecioVh_GetListaPrecio] ?, ?, ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $dFechaInicio,
                                                                $dFechaFin,
                                                                $nIdProveedor
                                                            ]);

        $arrayListaPrecioVh = ParametroController::arrayPaginator($arrayListaPrecioVh, $request);
        return ['arrayListaPrecioVh'=>$arrayListaPrecioVh];
    }

    public function GetListaVhDetalle(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdListaPrecioVersionVeh   = $request->nidlistaprecioversionveh;
        $nIdMarca                   = $request->nidmarca;
        $nIdModelo                  = $request->nidmodelo;
        $cNombreComercial           = $request->cnombrecomercial;


        $nIdMarca           = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo          = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $cNombreComercial   = ($cNombreComercial == NULL) ? ($cNombreComercial = '') : $cNombreComercial;

        $arrayListaPrecioVhDet = DB::select('exec [usp_ListaPrecioVh_GetDetalleById] ?, ?, ?, ?',
                                                        [
                                                            $nIdListaPrecioVersionVeh,
                                                            $nIdMarca,
                                                            $nIdModelo,
                                                            $cNombreComercial
                                                        ]);

        $arrayListaPrecioVhDet = ParametroController::arrayPaginator($arrayListaPrecioVhDet, $request);
        return ['arrayListaPrecioVhDet'=>$arrayListaPrecioVhDet];
    }

    public function SetListaVh(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $versionvehiculo = DB::select('exec [usp_ListaPrecioVh_SetListaPrecio] ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $request->nIdEmpresa,
                                                                $request->nIdSucursal,
                                                                $request->nIdProveedor,
                                                                $request->nIdCronograma,
                                                                $request->nNroListaPrecio,
                                                                $request->dFechaInicio,
                                                                $request->nIdTipoLista,
                                                                Auth::user()->id
                                                            ]);
        return response()->json($versionvehiculo);
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $detalles = $request->data;

            $arrayListaExiste = [];
            $arrayNombreComercial = [];

            foreach($detalles as $ep=>$det)
            {
                $det['nIdVersionVeh'] = ($det['nIdVersionVeh'] == NULL) ? ($det['nIdVersionVeh']= 0) : $det['nIdVersionVeh'];
                $det['cNombreComercial'] = ($det['cNombreComercial'] == NULL) ? ($det['cNombreComercial']= '') : $det['cNombreComercial'];
                $det['nAnioFabricacion'] = ($det['nAnioFabricacion'] == NULL) ? ($det['nAnioFabricacion']= 0) : $det['nAnioFabricacion'];
                $det['nAnioModelo'] = ($det['nAnioModelo'] == NULL) ? ($det['nAnioModelo']= 0) : $det['nAnioModelo'];
                $det['cUnidadMedida'] = ($det['cUnidadMedida'] == NULL) ? ($det['cUnidadMedida']= '') : $det['cUnidadMedida'];
                $det['cMoneda'] = ($det['cMoneda'] == NULL) ? ($det['cMoneda']= '') : $det['cMoneda'];
                $det['fPrecioBase'] = ($det['fPrecioBase'] == NULL) ? ($det['fPrecioBase']= 0) : $det['fPrecioBase'];
                $det['fDescuento'] = ($det['fDescuento'] == NULL) ? ($det['fDescuento']= 0) : $det['fDescuento'];
                $det['fPrecioCierre'] = ($det['fPrecioCierre'] == NULL) ? ($det['fPrecioCierre']= 0) : $det['fPrecioCierre'];
                $det['fPlaca'] = ($det['fPlaca'] == NULL) ? ($det['fPlaca']= 0) : $det['fPlaca'];
                $det['fMargen'] = ($det['fMargen'] == NULL) ? ($det['fMargen']= 0) : $det['fMargen'];
                $det['fCostoDealer'] = ($det['fCostoDealer'] == NULL) ? ($det['fCostoDealer']= 0) : $det['fCostoDealer'];
                $det['fBono'] = ($det['fBono'] == NULL) ? ($det['fBono']= 0) : $det['fBono'];
                $det['fPrecioCierre2'] = ($det['fPrecioCierre2'] == NULL) ? ($det['fPrecioCierre2']= 0) : $det['fPrecioCierre2'];
                $det['fFlete'] = ($det['fFlete'] == NULL) ? ($det['fFlete']= 0) : $det['fFlete'];
                $det['fTYP'] = ($det['fTYP'] == NULL) ? ($det['fTYP']= 0) : $det['fTYP'];
                $det['fPrecioVentaP'] = ($det['fPrecioVentaP'] == NULL) ? ($det['fPrecioVentaP']= 0) : $det['fPrecioVentaP'];
                $det['fPrecioBonoDealer'] = ($det['fPrecioBonoDealer'] == NULL) ? ($det['fPrecioBonoDealer']= 0) : $det['fPrecioBonoDealer'];
                $det['fBonoEspecial'] = ($det['fBonoEspecial'] == NULL) ? ($det['fBonoEspecial']= 0) : $det['fBonoEspecial'];

                $objLista = DB::select('exec [usp_ListaPrecioVh_SetDetalle] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $request->nIdListaPrecioVersionVeh,
                                                                $det['nIdVersionVeh'],
                                                                $det['cNombreComercial'],
                                                                $det['nAnioFabricacion'],
                                                                $det['nAnioModelo'],
                                                                $det['cUnidadMedida'],
                                                                $det['cMoneda'],
                                                                $det['fPrecioBase'],
                                                                $det['fDescuento'],
                                                                $det['fPrecioCierre'],
                                                                $det['fPlaca'],
                                                                $det['fMargen'],
                                                                $det['fCostoDealer'],
                                                                $det['fBono'],
                                                                $det['fPrecioCierre2'],
                                                                $det['fFlete'],
                                                                $det['fTYP'],
                                                                $det['fPrecioVentaP'],
                                                                $det['fPrecioBonoDealer'],
                                                                $det['fBonoEspecial'],
                                                                Auth::user()->id
                                                            ]);

                if($objLista[0]->nFlagMsje == 0){
                    array_push($arrayListaExiste,$objLista[0]->cNombreComercial);
                }
                if($objLista[0]->nFlagMsje == 3){
                    array_push($arrayNombreComercial,$objLista[0]->cNombreComercial);
                }
            }
            $data = [
                'arrayListaExiste'=>$arrayListaExiste,
                'arrayNombreComercial'=>$arrayNombreComercial
            ];
            DB::commit();
            return response()->json($data);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $listapreciovh = DB::select('exec [usp_ListaPrecioVh_DesactivaById] ?, ?, ?, ?, ?',
                                                [   $request->nIdEmpresa,
                                                    $request->nIdSucursal,
                                                    $request->nIdProveedor,
                                                    $request->nIdListaPrecioVersionVeh,
                                                    Auth::user()->id
                                                ]);
        return response()->json($listapreciovh);
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $listapreciovh = DB::select('exec [usp_ListaPrecioVh_ActivaById] ?, ?, ?, ?, ?, ?',
                                                    [   $request->nIdEmpresa,
                                                        $request->nIdSucursal,
                                                        $request->nIdProveedor,
                                                        $request->nIdListaPrecioVersionVeh,
                                                        $request->nIdTipoLista,
                                                        Auth::user()->id
                                                    ]);
        return response()->json($listapreciovh);
    }

    public function desactivarDetalle(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $listapreciovh = DB::select('exec [usp_ListaPrecioVh_DesactivaDetalleById] ?, ?',
                                                [   $request->nIdListaPrecioVersionVehDetalle,
                                                    Auth::user()->id
                                                ]);
        return response()->json($listapreciovh);
    }
}

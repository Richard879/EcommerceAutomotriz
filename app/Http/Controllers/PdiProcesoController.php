<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PdiProcesoController extends Controller
{
    public function GetListSolicitudByEstado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa  = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdEstadoSolicitud = $request->nidestadosolicitud;

        $arraySolicitud = DB::select('exec [usp_Pdi_GetListSolicitudByEstado] ?, ?, ?',
                                                                    [   $nIdEmpresa,
                                                                        $nIdSucursal,
                                                                        $nIdEstadoSolicitud
                                                                    ]);

        $arraySolicitud = ParametroController::arrayPaginator($arraySolicitud, $request);
        return ['arraySolicitud'=>$arraySolicitud];
    }

    public function GetListCompra(Request $request)
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

        $arrayCompra = DB::select('exec [usp_Pdi_GetListCompra] ?, ?, ?, ?, ?, ?, ?, ?',
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

    public function GetListSeccion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa   = $request->nidempresa;
        $nIdTipoInspeccion = $request->nidtipoinspeccion;
        $nIdFlag = $request->nidflag;
        $nIdFlag = ($nIdFlag == NULL) ? ($nIdFlag = 0) : $nIdFlag;

        $arraySeccion = DB::select('exec [usp_Pdi_GetListSeccion] ?, ?, ?',
                                                                    [   $nIdEmpresa,
                                                                        $nIdTipoInspeccion,
                                                                        $nIdFlag
                                                                    ]);
        return response()->json($arraySeccion);
    }

    public function GetListItem(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa   = $request->nidempresa;
        $nIdTipoInspeccion = $request->nidtipoinspeccion;
        $nIdFlag = $request->nidflag;
        $nIdFlag = ($nIdFlag == NULL) ? ($nIdFlag = 0) : $nIdFlag;

        $arrayItems = DB::select('exec [usp_Pdi_GetListItem] ?, ?, ?',
                                                                    [   $nIdEmpresa,
                                                                        $nIdTipoInspeccion,
                                                                        $nIdFlag
                                                                    ]);
        return response()->json($arrayItems);
    }

    public function SetCabeceraInspeccion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $pdi = DB::select('exec [usp_Pdi_SetCabeceraInspeccion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdPuntoInspeccion,
                                                                    $request->nIdSolicitudAutorizacion,
                                                                    $request->nIdCompra,
                                                                    $request->nIdVehiculoPlaca,
                                                                    $request->nIdTipoInspeccion,
                                                                    $request->cIdAlmacen,
                                                                    $request->cNumeroInspeccion,
                                                                    $request->dFechaInspeccion,
                                                                    $request->cHoraInspeccion,
                                                                    $request->cFlagTipoMovimiento,
                                                                    $request->cFlagVinPlaca,
                                                                    $request->cNumeroMovimientoAlmacen,
                                                                    $request->dFechaMovimientoAlmacen,
                                                                    $request->cFlagEstadoAprobacion,
                                                                    $request->cObservacion,
                                                                    $request->cNumeroVinExhibicion,
                                                                    Auth::user()->id
                                                                ]);
        return response()->json($pdi);
    }

    public function UpdCabeceraInspeccion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $pdi = DB::select('exec [usp_Pdi_UpdCabeceraInspeccion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $request->nIdCabeceraInspeccion,
                                                                    $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdAlmacen,
                                                                    $request->cNumeroInspeccion,
                                                                    $request->dFechaInspeccion,
                                                                    $request->cHoraInspeccion,
                                                                    $request->cNumeroMovimientoAlmacen,
                                                                    $request->dFechaMovimientoAlmacen,
                                                                    $request->cFlagEstadoAprobacion,
                                                                    $request->cObservacion,
                                                                    Auth::user()->id
                                                                ]);
        return response()->json($pdi);
    }

    public function GetLstVehiculoPaca(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         = $request->nidempresa;
        $nIdSucursal        = $request->nidsucursal;
        $cNumeroVehiculo    = $request->cnrovehiculo;
        $nCriterio          = $request->criterio;

        $cNumeroVehiculo  = ($cNumeroVehiculo == NULL) ? ($cNumeroVehiculo = ' ') : $cNumeroVehiculo;

        $arrayVehiculoPlaca = DB::select('exec [usp_Pdi_GetLstVehiculoPaca] ?, ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $cNumeroVehiculo,
                                                                $nCriterio
                                                            ]);

        $arrayVehiculoPlaca = Parametro::arrayPaginator($arrayVehiculoPlaca, $request);
        return ['arrayVehiculoPlaca'=>$arrayVehiculoPlaca];
    }

    public function GetListPdi(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa             =   $request->nidempresa;
        $nIdSucursal            =   $request->nidsucursal;
        $nCriterio              =   $request->ncriterio;
        $cDescripcionCiterio    =   $request->cdescripcioncriterio;
        $dFechaInicio           =   $request->dfechainicio;
        $dFechaFin              =   $request->dfechafin;
        $nIdTipoInspeccion      =   $request->nidtipoinspeccion;
        $nIdEstadoPdi           =   $request->nidestadopdi;

        $nIdTipoInspeccion   = ($nIdTipoInspeccion == NULL) ? ($nIdTipoInspeccion = 0) : $nIdTipoInspeccion;
        $nIdEstadoPdi   = ($nIdEstadoPdi == NULL) ? ($nIdEstadoPdi = 0) : $nIdEstadoPdi;

        $arrayPdi = DB::select('exec [usp_Pdi_GetListPdi] ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nCriterio,
                                                                $cDescripcionCiterio,
                                                                $dFechaInicio,
                                                                $dFechaFin,
                                                                $nIdTipoInspeccion,
                                                                $nIdEstadoPdi
                                                            ]);

        //$arrayPdi = Parametro::arrayPaginator($arrayPdi, $request);
        return ['arrayPdi'=>$arrayPdi];
    }

    public function GetDetalleTipoInspeccionById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa   = $request->nidempresa;
        $nIdTipoInspeccion = $request->nidtipoinspeccion;

        $arrayTipoInspeccion = DB::select('exec [usp_Pdi_GetDetalleTipoInspeccionById] ?, ?',
                                                                    [   $nIdEmpresa,
                                                                        $nIdTipoInspeccion
                                                                    ]);

        return response()->json($arrayTipoInspeccion);
    }

    public function GetListPuntoInspeccion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa  = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $cNombrePuntoInspeccion = $request->cnombre;

        $cNombrePuntoInspeccion = ($cNombrePuntoInspeccion == NULL) ? ($cNombrePuntoInspeccion = '') : $cNombrePuntoInspeccion;

        $arrayPuntoInspeccion = DB::select('exec [usp_Pdi_GetListPuntoInspeccion] ?, ?, ?',
                                                                                    [   $nIdEmpresa,
                                                                                        $nIdSucursal,
                                                                                        $cNombrePuntoInspeccion
                                                                                    ]);

        $arrayPuntoInspeccion = ParametroController::arrayPaginator($arrayPuntoInspeccion, $request);
        return ['arrayPuntoInspeccion'=>$arrayPuntoInspeccion];
    }

    public function SetPlantillaPdi(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $detalles = $request->data;

            foreach($detalles as $ep=>$det)
            {
                DB::select('exec [usp_Pdi_SetDetallePlantillaPdi] ?, ?, ?, ?, ?',
                                                    [   $request->nIdCabeceraInspeccion,
                                                        $det['nIdPlantillaInspeccionSeccionItem'],
                                                        $det['cFlagMarca'],
                                                        $det['cDescripcionNoConformidad'],
                                                        Auth::user()->id
                                                    ]);
            }

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetAccesorioPdi(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $detalles = $request->data;

            foreach($detalles as $ep=>$det)
            {
                DB::select('exec [usp_Pdi_SetDetalleAccerioPdi] ?, ?, ?, ?, ?, ?, ?',
                                                    [   $request->nIdCabeceraInspeccion,
                                                        $det['nIdAccesorio'],
                                                        $det['nCantidad'],
                                                        $det['cFlagMarca'],
                                                        $det['cDescripcionNoConformidad'],
                                                        $det['cWhsCode'],
                                                        Auth::user()->id
                                                    ]);
            }

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetCabeceraInspeccionDocumento(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayPedido = DB::select('exec [usp_Pdi_SetCabeceraInspeccionDocumento] ?, ?, ?',
                                    [
                                        $request->nIdCabeceraInspeccion,
                                        $request->nIdDocumentoAdjunto,
                                        Auth::user()->id
                                    ]);

        return response()->json($arrayPedido);
    }

    public function GetElementoByTipo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         = $request->nidempresa;
        $nIdTipoElemento    = $request->nidtipoelemen;
        $cElemenNombre      = $request->celementonombre;
        $nIdTipoElemento    = ($nIdTipoElemento == NULL) ? ($nIdTipoElemento = 0) : $nIdTipoElemento;
        $cElemenNombre      = ($cElemenNombre == NULL) ? ($cElemenNombre = '') : $cElemenNombre;

        $arrayElementoVenta = DB::select('exec [usp_Pdi_GetElementoByTipo] ?, ?, ?',
                                                                [   $nIdEmpresa,
                                                                    $nIdTipoElemento,
                                                                    $cElemenNombre
                                                                ]);

        //$arrayElementoVenta = ParametroController::arrayPaginator($arrayElementoVenta, $request);
        return ['arrayElementoVenta'=>$arrayElementoVenta];
    }

    public function GetAccesoriosPdiEntrada(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidempresa     =   $request->nidempresa;
        $tipoBsq        =   $request->nidtipoelemen;
        $codVehiculo    =   $request->codVehiculo;

        $tipoBsq        =   ($tipoBsq == NULL) ? ($tipoBsq = 1) : $tipoBsq;
        $codVehiculo    =   ($codVehiculo == NULL) ? ($codVehiculo = '') : $codVehiculo;

        $arrayElementoVenta = DB::select('exec [usp_Pdi_GetAccesoriosPdiEntrada] ?, ?, ?',
                                                                [   $nidempresa,
                                                                    $tipoBsq,
                                                                    $codVehiculo
                                                                ]);

        //$arrayElementoVenta = ParametroController::arrayPaginator($arrayElementoVenta, $request);
        return ['arrayElementoVenta'=>$arrayElementoVenta];
    }

    public function GetDetallePDI(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa             =   $request->nidempresa;
        $nIdSucursal            =   $request->nidsucursal;
        $nIdCabeceraInspeccion  =   $request->nIdCabeceraInspeccion;
        $nCriterio              =   $request->ncriterio;

        $arrayPdi = DB::select('exec [usp_Pdi_GetDetallePDI] ?, ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdCabeceraInspeccion,
                                                                $nCriterio
                                                            ]);

        $arrayPdi = Parametro::arrayPaginator($arrayPdi, $request);
        return ['arrayPdi'=>$arrayPdi];
    }

    public function GetAccesoriosPdiEntregaVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidempresa     =   $request->nidempresa;
        $tipoBsq        =   $request->tipoBsq;
        $codVehiculo    =   $request->codVehiculo;

        $tipoBsq        =   ($tipoBsq == NULL) ? ($tipoBsq = 1) : $tipoBsq;
        $codVehiculo    =   ($codVehiculo == NULL) ? ($codVehiculo = '') : $codVehiculo;

        $arrayElementoVenta = DB::select('exec [usp_Pdi_GetAccesoriosPdiEntregaVehiculo] ?, ?, ?',
                                                                [   $nidempresa,
                                                                    $tipoBsq,
                                                                    $codVehiculo
                                                                ]);
        //$arrayElementoVenta = ParametroController::arrayPaginator($arrayElementoVenta, $request);
        return ['arrayElementoVenta'=>$arrayElementoVenta];
    }

    public function GetListDetalleAccesorio(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa             =   $request->nidempresa;
        $nIdSucursal            =   $request->nidsucursal;
        $nIdCabeceraInspeccion  =   $request->nidcabecerainspeccion;
        $cElemenNombre          =   $request->cnombre;
        $nCriterio              =   $request->ncriterio;
        $cDescripcionCiterio    =   $request->cnumerovin;

        $cElemenNombre          =   ($cElemenNombre == NULL) ? ($cElemenNombre = '') : $cElemenNombre;

        $arrayDetalleAccesorio = DB::select('exec [usp_Pdi_GetListDetalleAccesorio] ?, ?, ?, ?',
                                                                [   $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $nIdCabeceraInspeccion,
                                                                    $cElemenNombre
                                                                ]);

        $arrayPdi = DB::select('exec [usp_Pdi_GetListPdiPDF] ?, ?, ?, ?, ?',
                                                [   $nIdEmpresa,
                                                    $nIdSucursal,
                                                    $nIdCabeceraInspeccion,
                                                    $nCriterio,
                                                    $cDescripcionCiterio
                                                ]);

        $arrayDetalleAccesorio = ParametroController::arrayPaginator($arrayDetalleAccesorio, $request);

        return [
            'arrayDetalleAccesorio' =>  $arrayDetalleAccesorio,
            'arrayPdi'              =>  $arrayPdi
        ];
    }

    public function GetReportePDI(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa             =   $request->nIdEmpresa;
        $nIdSucursal            =   $request->nIdSucursal;
        $nIdCabeceraInspeccion  =   $request->nIdCabeceraInspeccion;
        $nCriterio              =   $request->ncriterio;
        $cDescripcionCiterio    =   $request->cnumerovin;

        if ($nIdEmpresa == 1300011) {
            $img_empresa    =   public_path('img/automotoresinka.png');//CAPTURO LA RUTA DEL LOGO
            $img_marca      =   public_path('img/hyundai.png');//CAPTURO LA RUTA DE HYUNDAI
        } else {
            $img_empresa    =   public_path('img/inkalider.jpg');//CAPTURO LA RUTA DEL LOGO
            $img_marca      =   public_path('img/nissan.jpg');//CAPTURO LA RUTA DE HYUNDAI
        }

        $arrayDetalleAccesorio  =   DB::select('exec [usp_Pdi_GetListDetalleAccesorio] ?, ?, ?',
                                                [
                                                    $nIdEmpresa,
                                                    $nIdSucursal,
                                                    $nIdCabeceraInspeccion
                                                ]);

        $arrayPdi = DB::select('exec [usp_Pdi_GetListPdiPDF] ?, ?, ?, ?, ?',
                                                [   $nIdEmpresa,
                                                    $nIdSucursal,
                                                    $nIdCabeceraInspeccion,
                                                    $nCriterio,
                                                    $cDescripcionCiterio
                                                ]);

        $pdf = \PDF::loadView('pdf.pdi.generar', [
                                                'arrayPdi'                  =>  $arrayPdi,
                                                'arrayDetalleAccesorio'     =>  $arrayDetalleAccesorio,
                                                'img_empresa'               =>  $img_empresa,
                                                'img_marca'                 =>  $img_marca,
                                                'nIdEmpresa'                =>  $nIdEmpresa
                                            ]);

        return $pdf->download('PDI -'.$nIdCabeceraInspeccion.'.pdf');
    }

    public function subirArchivo(Request $request)
    {
        $nidcabecerainspeccion = $request->nidcabecerainspeccion;
        $file = $request->file;

        $bandera = str_random(10);
        $nombreArchivoServidor = $bandera .'_'. $file->getClientOriginalName();

        $ruta = Storage::putFileAs('public/PDI', $file, $nombreArchivoServidor);

        $arrayDocumento = DB::select('exec usp_Pdi_SetPdiArchivo ?, ?, ?, ?',
                                                        [
                                                            $nidcabecerainspeccion,
                                                            asset('storage/PDI/' . $nombreArchivoServidor),
                                                            $file->getClientOriginalName(),
                                                            Auth::user()->id
                                                        ]);

        return response()->json($arrayDocumento);
    }

    public function activarInactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayPdi = DB::select('exec [usp_Pdi_UpdActivaInactiva] ?, ?, ?, ?, ?',
                                            [   $request->nIdEmpresa,
                                                $request->nIdSucursal,
                                                $request->nIdCabeceraInspeccion,
                                                $request->cSituacionRegistro,
                                                Auth::user()->id
                                            ]);
        return response()->json($arrayPdi);
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
// use App\Compra;
use App\ListaPrecioVersionVeh;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use App\Exports\CompraExport;
use App\Exports\ExportDetalleVentaRetail;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function importFileCompra(Request $request)
    {
        $file       =   $request->file;
        $bandera    =   str_random(10);
        $ruta       =   Storage::putFileAs('uploads/ExcelCompra', $file, $bandera .'_'. $file->getClientOriginalName());
        return $ruta;

        /*$nameFile = $request->file->store('uploads/ExcelCompra');
        return response()->json($nameFile);*/

        /*return response()->json([
            'nombreFile' => $nameFile,
            'textoFile' => $textFile
        ]);*/
    }

    public function readFileCompra(Request $request)
    {
        $nameFile       =   $request->nameFile;
        $reader         =   new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $fxls           =   storage_path('app/'.$nameFile);
        $spreadsheet    =   \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
        $sheetData      =   $spreadsheet->getActiveSheet()->toArray();

        $cont = 0;
        $data = [];
        foreach ($sheetData as $key => $value) {
            if($value[3]!='' || $value[3]!=null){
                $data[$key+1] =[
                    'nItem'             => $cont,
                    'cNombreLinea'      => $value[0],
                    'cNombreAlmacen'    => $value[1],
                    'nNumeroReserva'    => $value[2],
                    'cNumeroVin'        => $value[3],
                    'cFormaPago'        => $value[4],
                    'cNombreMarca'      => $value[5],
                    'cNombreModelo'     => $value[6],
                    'cNombreComercial'  => $value[7],
                    'cNombreColor'      => ($value[8] == NULL) ? ($value[8] = '') : $value[8],
                    'nAnioFabricacion'  => ($value[9] == NULL) ? ($value[9] = 0) : $value[9],
                    'nAnioVersion'      => $value[10],
                    'cSimboloMoneda'    => $value[11],
                    'fTotalCompra'      => $value[12],
                    'cSerieComprobante' => ($value[13] == NULL) ? ($value[13] = '') : $value[13],
                    'cNumeroComprobante'=> ($value[14] == NULL) ? ($value[14] = '') : $value[14],
                    'dFechaFacturado'   => $value[15],
                    'cItemType'         => 'itItems'
                ];
                $cont++;
            }
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }

    public function exportCompraXLS(Request $request)
    {
        $nIdEmpresa     =   $request->nidempresa;
        $nIdSucursal    =   $request->nidsucursal;
        $dFechaInicio   =   $request->dfechainicio;
        $dFechaFin      =   $request->dfechafin;
        $nOrdenCompra   =   $request->nordencompra;
        $cNumeroVIN     =   $request->cnumerovin;
        $nIdMarca       =   $request->nidmarca;
        $nIdModelo     =   $request->nidmodelo;


        $dFechaInicio   =   ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin      =   ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $nOrdenCompra   =   ($nOrdenCompra == NULL) ? ($nOrdenCompra = '') : $nOrdenCompra;
        $cNumeroVin     =   ($cNumeroVIN == NULL) ? ($cNumeroVIN = '') : $cNumeroVIN;
        $nIdMarca       =   ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo      =   ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;

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

        return $arrayCompra;

        // return (new CompraExport($request))->download('invoices.csv', \Maatwebsite\Excel\Excel::CSV);
        // return (new CompraExport($request))->download('invoices.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        // return (new CompraExport($request))->download('invoices.pdf', \Maatwebsite\Excel\Excel::DOMPDF);

        // custom mime type text/csv
        // return (new CompraExport($request))->download(
        //     'invoices.csv',
        //     \Maatwebsite\Excel\Excel::CSV,
        //     [
        //         'Content-Type' => 'text/csv',
        //     ]
        // );
    }

    public function importFileListaPrecioVh(Request $request)
    {
        $file       =   $request->file;
        $bandera    =   str_random(10);
        $ruta       =   Storage::putFileAs('uploads/ExcelListaPrecio', $file, $bandera .'_'. $file->getClientOriginalName());
        return $ruta;
    }

    public function readFileListaPrecioVh(Request $request)
    {
        $nameFile       =   $request->nameFile;
        $reader         =   new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $fxls           =   storage_path('app/'.$nameFile);
        $spreadsheet    =   \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
        $sheetData      =   $spreadsheet->getActiveSheet()->toArray();

        $cont = 0;
        $data = [];
        foreach ($sheetData as $key => $value) {
            if($value[0]!='' || $value[0]!=null){
                //$value[15] = ($value[15] == NULL) ? ($value[15]= 0) : $value[15];
                $data[$key+1] =[
                    'nIdVersionVeh'     => $cont,
                    'cNombreComercial'  => $value[0],
                    'nAnioFabricacion'  => $value[1],
                    'nAnioModelo'       => $value[2],
                    'cUnidadMedida'     => $value[3],
                    'cMoneda'           => $value[4],
                    'fPrecioBase'       => $value[5],
                    'fDescuento'        => $value[6],
                    'fPrecioCierre'     => $value[7],
                    'fPlaca'            => $value[8],
                    'fMargen'           => $value[9],
                    'fCostoDealer'      => $value[10],
                    'fBono'             => $value[11],
                    'fPrecioCierre2'    => $value[12],
                    'fFlete'            => $value[13],
                    'fTYP'              => $value[14],
                    'fPrecioVentaP'     => $value[15],
                    'fPrecioBonoDealer' => $value[16],
                    'fBonoEspecial'     => $value[17]
                ];
                $cont++;
            }
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }

    public function importFileLeads(Request $request)
    {
        $file       =   $request->file;
        $bandera    =   str_random(10);
        $ruta       =   Storage::putFileAs('uploads/ExcelLeads', $file, $bandera .'_'. $file->getClientOriginalName());
        return $ruta;
    }

    public function readFileLeads(Request $request)
    {
        $nameFile       =   $request->nameFile;
        $reader         =   new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $fxls           =   storage_path('app/'.$nameFile);
        $spreadsheet    =   \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
        $sheetData      =   $spreadsheet->getActiveSheet()->toArray();

        $data = [];
        foreach ($sheetData as $key => $value) {
            $data[$key+1] =[
                'cTipoDocumento'   => $value[0],
                'cNumeroDocumento' => $value[1],
                'cNombre' => $value[2],
                'cApellidoPaterno' => $value[3],
                'cApellidoMaterno' => $value[4],
                'cTelefonoFijo' => $value[5],
                'nTelefonoMovil' => $value[6],
                'cEmail' => $value[7],
                'cDepartamentoNombre' => $value[8],
                'cProvinciaNombre' => $value[9],
                'cDistritoNombre' => $value[10],
                'cDireccion' => $value[11],
                'cLineaNombre' => $value[12],
                'cMarcaNombre' => $value[13],
                'cModeloNombre' => $value[14],
                'nAnioFabricacion' => $value[15],
                'nAnioModelo' => $value[16],
                'cGlosa' => $value[17]
            ];
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }

    public function importFileForum(Request $request)
    {
        $file       =   $request->file;
        $bandera    =   str_random(10);
        $ruta       =   Storage::putFileAs('uploads/ExcelForum', $file, $bandera .'_'. $file->getClientOriginalName());
        return $ruta;
    }

    public function readFileForum(Request $request)
    {
        $nameFile       =   $request->nameFile;
        $reader         =   new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $fxls           =   storage_path('app/'.$nameFile);
        $spreadsheet    =   \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
        $sheetData      =   $spreadsheet->getActiveSheet()->toArray();

        $data = [];
        foreach ($sheetData as $key => $value) {
            if($value[1]!='' || $value[1]!=null){
                $data[$key+1] =[
                    'cNombreModelo' => $value[0],
                    'cNumeroVin'    => $value[1],
                    'cNumeroMotor'  => $value[2],
                    'cNombreColor'  => $value[3],
                    'cMoneda'       => $value[4],
                    'fTotalCompra'  => $value[5],
                    'dFecha'        => $value[6]
                ];
            }
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }

    public function importFileExhibicion(Request $request)
    {
        $file       =   $request->file;
        $bandera    =   str_random(10);
        $ruta       =   Storage::putFileAs('uploads/ExcelExhibicion', $file, $bandera .'_'. $file->getClientOriginalName());
        return $ruta;
    }

    public function readFileExhibicion(Request $request)
    {
        $nameFile       =   $request->nameFile;
        $reader         =   new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $fxls           =   storage_path('app/'.$nameFile);
        $spreadsheet    =   \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
        $sheetData      =   $spreadsheet->getActiveSheet()->toArray();

        $data = [];
        foreach ($sheetData as $key => $value) {
            if($value[2]!='' || $value[2]!=null){
                $data[$key+1] =[
                    'cNombreLinea' => $value[0],
                    'cNombreAlmacen' => $value[1],
                    'cNumeroVin' => $value[2],
                    'cNombreMarca' => $value[3],
                    'cNombreModelo' => $value[4],
                    'cNombreComercial' => $value[5],
                    'cNombreColor' => $value[6],
                    'nAnioFabricacion' => $value[7],
                    'nAnioModelo' => $value[8],
                    'cSimboloMoneda' => $value[9],
                    'fTotalExhibicion' => $value[10]
                ];
            }
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }

    public function importFileProyecto(Request $request)
    {
        $file       =   $request->file;
        $bandera    =   str_random(10);
        $ruta       =   Storage::putFileAs('uploads/ExcelProyecto', $file, $bandera .'_'. $file->getClientOriginalName());
        return $ruta;
    }

    public function readFileProyecto(Request $request)
    {
        $nameFile       =   $request->nameFile;
        $reader         =   new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $fxls           =   storage_path('app/'.$nameFile);
        $spreadsheet    =   \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
        $sheetData      =   $spreadsheet->getActiveSheet()->toArray();

        $cont = 0;
        $data = [];
        foreach ($sheetData as $key => $value) {
            if($value[0]!='' || $value[0]!=null){
                $data[$key+1] =[
                    'nIdContador'       => $cont,
                    'nIdTipoDocumento'  => $value[0],
                    'cNumeroDocumento'  => $value[1],
                    'cNombre'           => $value[2],
                    'cApellidoPaterno'  => $value[3],
                    'cApellidoMaterno'  => $value[4],
                    'cUbigeo'           => $value[5],
                    'cDireccion'        => $value[6],
                    'cEmail'            => $value[7],
                    'cTelefonoFijo'     => $value[8],
                    'nTelefonoMovil'    => $value[9],
                    'nIdVendedor'       => $value[10],
                    'cNombreVendedor'   => $value[11]
                ];
                $cont++;
            }
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }

    //========================= REPOTES =========================
    public function exportDetalleVentaRetail(Request $request)
    {
        $nidsucursal    =   $request->nidsucursal;
        $nidvendedor    =   $request->nidvendedor;
        $nIdUsuario     =   Auth::user()->id;

        $nidsucursal    =   ($nidsucursal == NULL) ? ($nidsucursal = 0) : $nidsucursal;
        $nidvendedor    =   ($nidvendedor == NULL) ? ($nidvendedor = 0) : $nidvendedor;

        $opcion         =   $request->opcion;

        $data = DB::select('exec [usp_Reporte_GetDetalleVentaRetail] ?, ?, ?',
                                                            [
                                                                $nidsucursal,
                                                                $nidvendedor,
                                                                $nIdUsuario
                                                            ]);

        if ($opcion == 1) {
            return response()->json($data);
        } else {
            $arrayDetalleVentaRetail = ParametroController::arrayPaginator($data, $request);
            return ['arrayDetalleVentaRetail'=>$arrayDetalleVentaRetail];
        }
        // $type = $request->type;
        // return Excel::download(new ExportDetalleVentaRetail, 'invoices.csv', \Maatwebsite\Excel\Excel::CSV);
        // return Excel::download(new ExportDetalleVentaRetail,'users.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function exportarVentaHGSI(Request $request)
    {
        $nidsucursal    =   $request->nidsucursal;
        $nidvendedor    =   $request->nidvendedor;
        $nidproveedor   =   $request->nidproveedor;
        $nidlinea       =   $request->nidlinea;
        $nidmarca       =   $request->nidmarca;
        $nidmodelo      =   $request->nidmodelo;
        $nIdUsuario     =   Auth::user()->id;

        $nidsucursal    =   ($nidsucursal == NULL) ? ($nidsucursal = 0) : $nidsucursal;
        $nidvendedor    =   ($nidvendedor == NULL) ? ($nidvendedor = 0) : $nidvendedor;
        $nidproveedor   =   ($nidproveedor == NULL) ? ($nidproveedor = 0) : $nidproveedor;
        $nidlinea       =   ($nidlinea == NULL) ? ($nidlinea = 0) : $nidlinea;
        $nidmarca       =   ($nidmarca == NULL) ? ($nidmarca = 0) : $nidmarca;
        $nidmodelo      =   ($nidmodelo == NULL) ? ($nidmodelo = 0) : $nidmodelo;

        $opcion         =   $request->opcion;

        $data = DB::select('exec [usp_Reporte_GetVentasHGSI] ?, ?, ?, ?, ?, ?, ?',
                                                                [
                                                                    $nidsucursal,
                                                                    $nidvendedor,
                                                                    $nidproveedor,
                                                                    $nidlinea,
                                                                    $nidmarca,
                                                                    $nidmodelo,
                                                                    $nIdUsuario
                                                                ]);

        if ($opcion == 1) {
            return response()->json($data);
        } else {
            $arrayVentaHGSI = ParametroController::arrayPaginator($data, $request);
            return ['arrayVentaHGSI'=>$arrayVentaHGSI];
        }
    }

    public function exportarVentaDiaria(Request $request)
    {
        $dfecha         =   $request->dfecha;
        $nidvendedor    =   $request->nidvendedor;

        $dfecha         =   ($dfecha == NULL) ? ($dfecha = '') : $dfecha;
        $nidvendedor    =   ($nidvendedor == NULL) ? ($nidvendedor = 0) : $nidvendedor;

        return $data = DB::select('exec [usp_Reporte_GetVentaDiaria] ?, ?',
                                            [
                                                $dfecha,
                                                $nidvendedor
                                            ]);
    }

    public function exportarStock(Request $request)
    {
        $nidsucursal        =   $request->nidsucursal;
        $nidproveedor       =   $request->nidproveedor;
        $nidlista           =   $request->nidlista;
        $cflagdisponible    =   $request->cflagdisponible;
        $nidmarca           =   $request->nidmarca;
        $nidmodelo          =   $request->nidmodelo;

        $opcion             =   $request->opcion;

        $cflagdisponible    =   ($cflagdisponible == NULL) ? ($cflagdisponible = '') : $cflagdisponible;
        $nidmarca           =   ($nidmarca == NULL) ? ($nidmarca = 0) : $nidmarca;
        $nidmodelo          =   ($nidmodelo == NULL) ? ($nidmodelo = 0) : $nidmodelo;

        $data = DB::select('exec [usp_Reporte_GetStockFiltro] ?, ?, ?, ?, ?, ?',
                                            [
                                                $nidsucursal,
                                                $nidproveedor,
                                                $nidlista,
                                                $cflagdisponible,
                                                $nidmarca,
                                                $nidmodelo
                                            ]);

        if ($opcion == 1) {
            return response()->json($data);
        } else {
            $arrayStockVehiculos = ParametroController::arrayPaginator($data, $request);
            return ['arrayStockVehiculos'=>$arrayStockVehiculos];
        }
    }

    public function exportarStockGeneral(Request $request)
    {
        $nidsucursal        =   $request->nidsucursal;
        $nidproveedor       =   $request->nidproveedor;
        $cflagdisponible    =   $request->cflagdisponible;
        $nidmarca           =   $request->nidmarca;
        $nidmodelo          =   $request->nidmodelo;

        $cflagdisponible    =   ($cflagdisponible == NULL) ? ($cflagdisponible = '') : $cflagdisponible;
        $nidsucursal        =   ($nidsucursal == NULL) ? ($nidsucursal = 0) : $nidsucursal;
        $nidproveedor       =   ($nidproveedor == NULL) ? ($nidproveedor = 0) : $nidproveedor;
        $nidmarca           =   ($nidmarca == NULL) ? ($nidmarca = 0) : $nidmarca;
        $nidmodelo          =   ($nidmodelo == NULL) ? ($nidmodelo = 0) : $nidmodelo;

        $opcion             =   $request->opcion;

        $data = DB::select('exec [usp_Reporte_GetStockGeneral] ?, ?, ?, ?, ?',
                                            [
                                                $nidsucursal,
                                                $nidproveedor,
                                                $cflagdisponible,
                                                $nidmarca,
                                                $nidmodelo
                                            ]);

        if ($opcion == 1) {
            return response()->json($data);
        } else {
            $arrayStockVehiculosGeneral = ParametroController::arrayPaginator($data, $request);
            return ['arrayStockVehiculosGeneral'=>$arrayStockVehiculosGeneral];
        }
    }

    public function exportarMetasVenta(Request $request)
    {
        $nidsucursal    =   $request->nidsucursal;
        $nidvendedor    =   $request->nidvendedor;
        $nidsublinea    =   $request->nidsublinea;
        $nidcronograma  =   $request->nidcronograma;

        $nidvendedor    =   ($nidvendedor == NULL) ? ($nidvendedor = 0) : $nidvendedor;
        $nidsublinea    =   ($nidsublinea == NULL) ? ($nidsublinea = 0) : $nidsublinea;

        $opcion             =   $request->opcion;

        $data = DB::select('exec [usp_Reporte_GetCuotaVendedor] ?, ?, ?, ?',
                                            [
                                                $nidsucursal,
                                                $nidvendedor,
                                                $nidsublinea,
                                                $nidcronograma
                                            ]);

        if ($opcion == 1) {
            return response()->json($data);
        } else {
            $arrayMetasVenta = ParametroController::arrayPaginator($data, $request);
            return ['arrayMetasVenta'=>$arrayMetasVenta];
        }
    }

    public function exportarContactosLibres(Request $request)
    {
        $nidsucursal    =   $request->nidsucursal;
        $nidvendedor    =   $request->nidvendedor;
        $dfecha         =   $request->dfecha;

        $nidsucursal    =   ($nidsucursal == NULL) ? ($nidsucursal = 0) : $nidsucursal;
        $nidvendedor    =   ($nidvendedor == NULL) ? ($nidvendedor = 0) : $nidvendedor;
        $dfecha         =   ($dfecha == NULL) ? ($dfecha = '') : $dfecha;

        $opcion         =   $request->opcion;

        $data = DB::select('exec [usp_Reporte_GetContactosLibres] ?, ?',
                                            [
                                                $nidvendedor,
                                                $dfecha
                                            ]);

        if ($opcion == 1) {
            return response()->json($data);
        } else {
            $arrayContactosLibres = ParametroController::arrayPaginator($data, $request);
            return ['arrayContactosLibres'=>$arrayContactosLibres];
        }
    }

    public function exportarDistribucionDesc(Request $request)
    {
        $nidsucursal            =   $request->nidsucursal;
        $nidvendedor            =   $request->nidvendedor;
        $nidcronograma          =   $request->nidcronograma;
        $nidestadocotizacion    =   $request->nidestadocotizacion;
        $fmontodescuento        =   $request->fmontodescuento;

        $nidsucursal            =   ($nidsucursal == NULL) ? ($nidsucursal = 0) : $nidsucursal;
        $nidvendedor            =   ($nidvendedor == NULL) ? ($nidvendedor = 0) : $nidvendedor;
        $nidcronograma          =   ($nidcronograma == NULL) ? ($nidcronograma = 0) : $nidcronograma;
        $nidestadocotizacion    =   ($nidestadocotizacion == NULL) ? ($nidestadocotizacion = 0) : $nidestadocotizacion;
        $fmontodescuento        =   ($fmontodescuento == NULL) ? ($fmontodescuento = 0) : $fmontodescuento;

        $opcion         =   $request->opcion;

        $data = DB::select('exec [usp_Reporte_GetDistribucionDesc] ?, ?, ?, ?, ?',
                                            [
                                                $nidsucursal,
                                                $nidvendedor,
                                                $nidcronograma,
                                                $nidestadocotizacion,
                                                $fmontodescuento
                                            ]);

        if ($opcion == 1) {
            return response()->json($data);
        } else {
            $arrayDistribucionDesc = ParametroController::arrayPaginator($data, $request);
            return ['arrayDistribucionDesc'=>$arrayDistribucionDesc];
        }
    }

    public function exportarPedidoDeposito(Request $request)
    {
        $nidsucursal        =   $request->nidsucursal;
        $nidvendedor        =   $request->nidvendedor;
        $nidcronograma      =   $request->nidcronograma;
        $nidestadopedido    =   $request->nidestadopedido;

        $nidsucursal        =   ($nidsucursal == NULL) ? ($nidsucursal = 0) : $nidsucursal;
        $nidvendedor        =   ($nidvendedor == NULL) ? ($nidvendedor = 0) : $nidvendedor;
        $nidcronograma      =   ($nidcronograma == NULL) ? ($nidcronograma = 0) : $nidcronograma;
        $nidestadopedido    =   ($nidestadopedido == NULL) ? ($nidestadopedido = 0) : $nidestadopedido;

        $opcion             =   $request->opcion;

        $data = DB::select('exec [usp_Reporte_GetEstadoPedido] ?, ?, ?, ?',
                                            [
                                                $nidsucursal,
                                                $nidvendedor,
                                                $nidcronograma,
                                                $nidestadopedido
                                            ]);

        if ($opcion == 1) {
            return response()->json($data);
        } else {
            $arrayPedidoDeposito = ParametroController::arrayPaginator($data, $request);
            return ['arrayPedidoDeposito'=>$arrayPedidoDeposito];
        }
    }
}

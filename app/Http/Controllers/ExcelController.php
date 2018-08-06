<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use App\Compra;
use App\ListaPrecioVersionVeh;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class ExcelController extends Controller
{

    public function importFileCompra(Request $request)
    {        
        //$textFile = $request->file->getClientOriginalName();
        $nameFile = $request->file->store('uploads');
        return response()->json($nameFile);
        /*return response()->json([
            'nombreFile' => $nameFile,
            'textoFile' => $textFile
        ]);*/
    }
    
    public function readFileCompra(Request $request)
    {
        $nameFile = $request->nameFile;
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $fxls = storage_path('app/'.$nameFile);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $data = [];
        foreach ($sheetData as $key => $value) {
            $data[$key+1] =[
                'nOrdenCompra'   => $value[0],
                'cNombreLinea' => $value[1],
                'cNombreAlmacen' => $value[2],
                'nNumeroReserva' => $value[3],
                'cNumeroVin' => $value[4],
                'cFormaPago' => $value[5],
                'cNombreMarca' => $value[6],
                'cNombreModelo' => $value[7],
                'cNombreComercial' => $value[8],
                'cNombreColor' => $value[9],
                'cAnioFabricacion' => $value[10],
                'cAnioVersion' => $value[11],
                'cSimboloMoneda' => $value[12],
                'fTotalCompra' => $value[13],
                'cNumeroFactura' => $value[14],
                'dFechaFacturado' => $value[15]
            ];
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }

    public function importFileListaPrecioVh(Request $request)
    {
        $nameFile = $request->file->store('uploads');
        return response()->json($nameFile);
    }
    
    public function readFileListaPrecioVh(Request $request)
    {
        $nameFile = $request->nameFile;
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $fxls = storage_path('app/'.$nameFile);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $data = [];
        foreach ($sheetData as $key => $value) {
            $data[$key+1] =[
                'nIdVersionVeh'   => $value[0],
                'cNombreComercial' => $value[1],
                'nAnioFabricacion' => $value[2],
                'nAnioModelo' => $value[3],
                'cUnidadMedida' => $value[4],
                'cMoneda' => $value[5],
                'FInicioProm ' => $value[6],
                'FFinProm' => $value[7],
                'fPrecioBase' => $value[8],
                'fDescuento' => $value[9],
                'fPrecioCierre' => $value[10],
                'fPlaca' => $value[11],
                'fMargen' => $value[12],
                'fCostoDealer' => $value[13],
                'fBono' => $value[14],
                'fPrecioCierre2' => $value[15],
                'fFlete' => $value[16],
                'fPrecioVentaP' => $value[17],
                'fFleteProveedor' => $value[18],
                'fPorcDsctoFp' => $value[19],
                'fFactorFc' => $value[20],
                'fDescuentoFc' => $value[21],
                'fPrecioBono' => $value[22],
                'fPrecioDealer' => $value[23],
                'fBonoEspecial' => $value[24]
            ];
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }
}
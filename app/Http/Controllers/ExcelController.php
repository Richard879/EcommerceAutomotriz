<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Compra;
use App\ListaPrecioVersionVeh;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class ExcelController extends Controller
{

    public function importFileCompra(Request $request)
    {    
        $file = $request->file;
        $bandera = str_random(10);
        $ruta = Storage::putFileAs('uploads/ExcelListaPrecio', $file, $bandera .'_'. $file->getClientOriginalName());
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
                'nAnioFabricacion' => $value[10],
                'nAnioVersion' => $value[11],
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
        $file = $request->file;
        $bandera = str_random(10);
        $ruta = Storage::putFileAs('uploads/ExcelListaPrecio', $file, $bandera .'_'. $file->getClientOriginalName());
        return $ruta;

        /*$nameFile = $request->file->store('uploads/ExcelListaPrecio');
        return response()->json($nameFile);*/
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
                'fPrecioBase' => $value[6],
                'fDescuento' => $value[7],
                'fPrecioCierre' => $value[8],
                'fPlaca' => $value[9],
                'fMargen' => $value[10],
                'fCostoDealer' => $value[11],
                'fBono' => $value[12],
                'fPrecioCierre2' => $value[13],
                'fFlete' => $value[14],
                'fTYP' => $value[15],
                'fPrecioVentaP' => $value[16],
                'fPrecioBonoDealer' => $value[17],
                'fBonoEspecial' => $value[18]
            ];
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }

    public function importFileLeads(Request $request)
    {
        $file = $request->file;
        $bandera = str_random(10);
        $ruta = Storage::putFileAs('uploads/ExcelLeads', $file, $bandera .'_'. $file->getClientOriginalName());
        return $ruta;
    }
    
    public function readFileLeads(Request $request)
    {
        $nameFile = $request->nameFile;
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $fxls = storage_path('app/'.$nameFile);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $data = [];
        foreach ($sheetData as $key => $value) {
            $data[$key+1] =[
                'cTipoDocumento'   => $value[0],
                'cNumeroDocumento' => $value[1],
                'cNombreCompleto' => $value[2],
                'cTelefono' => $value[3],
                'cCelular' => $value[4],
                'cEmail' => $value[5],
                'cDepartamentoNombre' => $value[6],
                'cProvinciaNombre' => $value[7],
                'cDistritoNombre' => $value[8],
                'cDirección' => $value[9],
                'cNombreMarca' => $value[10],
                'cNombreModelo' => $value[11],
                'cComentario' => $value[12]
            ];
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }
}
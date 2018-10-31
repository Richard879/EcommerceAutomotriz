<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Maatwebsite\Excel\Facades\Excel;

class ExhibicionController extends Controller
{
    public function SetExhibicion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;

            $arrayVinExiste = [];
            $arrayFormato = [];
            $arrayNombreComercial = [];

            foreach($detalles as $ep=>$det)
            {
                $objCompra = DB::select('exec [usp_Exhibicion_SetExhibicion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $request->nIdEmpresa,
                                                                $request->nIdSucursal,
                                                                $request->nIdCronograma,
                                                                $request->nIdProveedor,
                                                                $det['cNombreLinea'],
                                                                $det['cNombreAlmacen'],
                                                                $det['cNumeroVin'],
                                                                $det['cNombreMarca'],
                                                                $det['cNombreModelo'],
                                                                $det['cNombreComercial'],
                                                                $det['cNombreColor'],
                                                                $det['nAnioFabricacion'],
                                                                $det['nAnioVersion'],
                                                                $det['cSimboloMoneda'],
                                                                $det['fTotalExhibicion'],
                                                                Auth::user()->id
                                                            ]);
                if($objCompra[0]->nFlagMsje == 0){
                    array_push($arrayVinExiste,$objCompra[0]->cNumeroVin);
                }
                if($objCompra[0]->nFlagMsje == 2){
                    array_push($arrayFormato,$objCompra[0]->cNumeroVin);
                }
                if($objCompra[0]->nFlagMsje == 3){
                    array_push($arrayNombreComercial,$objCompra[0]->cNumeroVin);
                }
            }
            $data = [
                'arrayVinExiste'=>$arrayVinExiste,
                'arrayFormato'=>$arrayFormato,
                'arrayNombreComercial'=>$arrayNombreComercial
            ];
            DB::commit();
            return response()->json($data);            
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}

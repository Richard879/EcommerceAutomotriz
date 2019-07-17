<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ModeloConfigController extends Controller
{
    public function GetListModelos(Request $request)
    {
        $nIdEmpresa         =   $request->nIdEmpresa;
        $nIdProveedor       =   $request->nIdProveedor;
        $nIdLinea           =   $request->nIdLinea;
        $nIdMarca           =   $request->nIdMarca;
        $nIdModelo          =   $request->nIdModelo;
        $cNombreComercial   =   $request->cNombreComercial;

        $nIdEmpresa         =   ($nIdEmpresa == NULL) ? ($nIdEmpresa = 0) : $nIdEmpresa;
        $nIdProveedor       =   ($nIdProveedor == NULL) ? ($nIdProveedor = 0) : $nIdProveedor;
        $nIdLinea           =   ($nIdLinea == NULL) ? ($nIdLinea = 0) : $nIdLinea;
        $nIdMarca           =   ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo          =   ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $cNombreComercial   =   ($cNombreComercial == NULL) ? ($cNombreComercial = '') : $cNombreComercial;

        $data = DB::select('exec [usp_Modelo_GetListModelosByAnioModelo] ?, ?, ?, ?, ?, ?',
                                                [   $nIdEmpresa,
                                                    $nIdProveedor,
                                                    $nIdLinea,
                                                    $nIdMarca,
                                                    $nIdModelo,
                                                    $cNombreComercial
                                                ]);

        $arrayListModelos = ParametroController::arrayPaginator($data, $request);
        return ['arrayListModelos'=>$arrayListModelos];
    }

    public function SetRegistrarDocs(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $fileFotografia         =   $request->fileFotografia;
            $fileFichaTecnica       =   $request->fileFichaTecnica;
            $fileFichaTecnicaPDF    =   $request->fileFichaTecnicaPDF;
            $nIdModelo              =   $request->nidmodelo;
            $nAnioModelo            =   $request->naniomodelo;
            $nIdVersionVeh          =   $request->nidversionveh;
            $nIdUsuario             =   Auth::user()->id;

            $fileFotografia         =   ($fileFotografia == NULL)  ? ($fileFotografia = '') : $fileFotografia;
            $fileFichaTecnica       =   ($fileFichaTecnica == NULL)  ? ($fileFichaTecnica = '') : $fileFichaTecnica;
            $fileFichaTecnicaPDF    =   ($fileFichaTecnicaPDF == NULL)  ? ($fileFichaTecnicaPDF = '') : $fileFichaTecnicaPDF;
            $nIdModelo              =   ($nIdModelo == NULL)  ? ($nIdModelo = 0) : $nIdModelo;
            $nAnioModelo            =   ($nAnioModelo == NULL) ? ($nAnioModelo = 0) : $nAnioModelo;
            $nIdVersionVeh          =   ($nIdVersionVeh == NULL) ? ($nIdVersionVeh = 0) : $nIdVersionVeh;

            //VERIFICO SI EXISTE FOTOGRAFIA
            if($fileFotografia) {
                $banderaFoto = str_random(10);
                $nombreArchivoServidorFoto = $banderaFoto .'_'. $fileFotografia->getClientOriginalName();
                //Almaceno el archivo en un ruta especifica
                $ruta = Storage::putFileAs('public/ModeloAnio/Foto/', $fileFotografia, $nombreArchivoServidorFoto);
            }
            //GUARDO LA RUTA DEL ARCHIVO SI EXISTE
            $pcNombreRutaFotografia = ($fileFotografia) ? (asset('storage/ModeloAnio/Foto/' . $nombreArchivoServidorFoto)) : '';

            //VERIFICO SI EXISTE ARCHIVO XML
            if($fileFichaTecnica) {
                $banderaFicha = str_random(10);

                //PARSEAR ESPACIO BLANCO
                $archivo        = $fileFichaTecnica->getClientOriginalName();
                $archivoLimpio  = str_replace(" ", "_", $archivo);

                $nombreArchivoServidorFicha = $banderaFicha .'_'. $archivoLimpio;
                //Almaceno el archivo en un ruta especifica
                $ruta = Storage::putFileAs('public/ModeloAnio/Ficha/', $fileFichaTecnica, $nombreArchivoServidorFicha);
            }
            //GUARDO LA RUTA DEL ARCHIVO SI EXISTE
            $pcNombreRutaFichaTecnica = ($fileFichaTecnica) ? (asset('storage/ModeloAnio/Ficha/' . $nombreArchivoServidorFicha)) : '';

            //VERIFICO SI EXISTE ARCHIVO PDF
            if($fileFichaTecnicaPDF) {
                $banderaFicha = str_random(10);

                //PARSEAR ESPACIO BLANCO
                $archivo        = $fileFichaTecnicaPDF->getClientOriginalName();
                $archivoLimpio  = str_replace(" ", "_", $archivo);

                $nombreArchivoServidorFicha = $banderaFicha .'_'. $archivoLimpio;
                //Almaceno el archivo en un ruta especifica
                $ruta = Storage::putFileAs('public/ModeloAnio/FichaPDF/', $fileFichaTecnicaPDF, $nombreArchivoServidorFicha);
            }
            //GUARDO LA RUTA DEL ARCHIVO SI EXISTE
            $pcNombreRutaFichaTecnicaPDF = ($fileFichaTecnicaPDF) ? (asset('storage/ModeloAnio/FichaPDF/' . $nombreArchivoServidorFicha)) : '';

            $data = DB::select('exec usp_Modelo_SetRegistrarModeloDocs ?, ?, ?, ?, ?, ?, ?',
                                                            [
                                                                $pcNombreRutaFotografia,
                                                                $pcNombreRutaFichaTecnica,
                                                                $pcNombreRutaFichaTecnicaPDF,
                                                                $nIdModelo,
                                                                $nAnioModelo,
                                                                $nIdVersionVeh,
                                                                $nIdUsuario
                                                            ]);
            DB::commit();
            return response()->json($data);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetInfoDocsModelo(Request $request)
    {
        $nIdModelo          = $request->nidmodelo;
        $nAnioModelo        = $request->naniomodelo;
        $nIdVersionVeh      = $request->nidversionveh;

        $nIdModelo          = ($nIdModelo == NULL)  ? ($nIdModelo = 0) : $nIdModelo;
        $nAnioModelo        = ($nAnioModelo == NULL) ? ($nAnioModelo = 0) : $nAnioModelo;
        $nIdVersionVeh      = ($nIdVersionVeh == NULL) ? ($nIdVersionVeh = 0) : $nIdVersionVeh;

        $data = DB::select('exec [usp_Modelo_GetInfoDocsModelo] ?, ?, ?',
                                                [   $nIdModelo,
                                                    $nAnioModelo,
                                                    $nIdVersionVeh
                                                ]);
        return response()->json($data);
    }

    public function SetActualizarDocs(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $fileFotografia         =   $request->fileFotografia;
            $fileFichaTecnica       =   $request->fileFichaTecnica;
            $fileFichaTecnicaPDF    =   $request->fileFichaTecnicaPDF;
            $nIdModelo              =   $request->nidmodelo;
            $nAnioModelo            =   $request->naniomodelo;
            $nIdVersionVeh          =   $request->nidversionveh;
            $nIdUsuario             =   Auth::user()->id;

            $fileFotografia         =   ($fileFotografia == NULL)  ? ($fileFotografia = '') : $fileFotografia;
            $fileFichaTecnica       =   ($fileFichaTecnica == NULL)  ? ($fileFichaTecnica = '') : $fileFichaTecnica;
            $fileFichaTecnicaPDF    =   ($fileFichaTecnicaPDF == NULL)  ? ($fileFichaTecnicaPDF = '') : $fileFichaTecnicaPDF;
            $nIdModelo              =   ($nIdModelo == NULL)  ? ($nIdModelo = 0) : $nIdModelo;
            $nAnioModelo            =   ($nAnioModelo == NULL) ? ($nAnioModelo = 0) : $nAnioModelo;
            $nIdVersionVeh          =   ($nIdVersionVeh == NULL) ? ($nIdVersionVeh = 0) : $nIdVersionVeh;

            //VERIFICO SI EXISTE ARCHIVO
            if($fileFotografia) {
                $banderaFoto = str_random(10);
                $nombreArchivoServidorFoto = $banderaFoto .'_'. $fileFotografia->getClientOriginalName();
                //Almaceno el archivo en un ruta especifica
                $ruta = Storage::putFileAs('public/ModeloAnio/Foto/', $fileFotografia, $nombreArchivoServidorFoto);
            }
            //GUARDO LA RUTA DEL ARCHIVO SI EXISTE
            $pcNombreRutaFotografia = ($fileFotografia) ? (asset('storage/ModeloAnio/Foto/' . $nombreArchivoServidorFoto)) : '';

            //VERIFICO SI EXISTE ARCHIVO
            if($fileFichaTecnica) {
                $banderaFicha = str_random(10);

                //PARSEAR ESPACIO BLANCO
                $archivo        = $fileFichaTecnica->getClientOriginalName();
                $archivoLimpio  = str_replace(" ", "_", $archivo);

                $nombreArchivoServidorFicha = $banderaFicha .'_'. $archivoLimpio;
                //Almaceno el archivo en un ruta especifica
                $ruta = Storage::putFileAs('public/ModeloAnio/Ficha/', $fileFichaTecnica, $nombreArchivoServidorFicha);
            }
            //GUARDO LA RUTA DEL ARCHIVO SI EXISTE
            $pcNombreRutaFichaTecnica = ($fileFichaTecnica) ? (asset('storage/ModeloAnio/Ficha/' . $nombreArchivoServidorFicha)) : '';

            //VERIFICO SI EXISTE ARCHIVO PDF
            if($fileFichaTecnicaPDF) {
                $banderaFicha = str_random(10);

                //PARSEAR ESPACIO BLANCO
                $archivo        = $fileFichaTecnicaPDF->getClientOriginalName();
                $archivoLimpio  = str_replace(" ", "_", $archivo);

                $nombreArchivoServidorFicha = $banderaFicha .'_'. $archivoLimpio;
                //Almaceno el archivo en un ruta especifica
                $ruta = Storage::putFileAs('public/ModeloAnio/FichaPDF/', $fileFichaTecnicaPDF, $nombreArchivoServidorFicha);
            }
            //GUARDO LA RUTA DEL ARCHIVO SI EXISTE
            $pcNombreRutaFichaTecnicaPDF = ($fileFichaTecnicaPDF) ? (asset('storage/ModeloAnio/FichaPDF/' . $nombreArchivoServidorFicha)) : '';

            $data = DB::select('exec usp_Modelo_SetActualizarModeloDocs ?, ?, ?, ?, ?, ?, ?',
                                                            [
                                                                $pcNombreRutaFotografia,
                                                                $pcNombreRutaFichaTecnica,
                                                                $pcNombreRutaFichaTecnicaPDF,
                                                                $nIdModelo,
                                                                $nAnioModelo,
                                                                $nIdVersionVeh,
                                                                $nIdUsuario
                                                            ]);
            DB::commit();
            return response()->json($data);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetEliminarXMLByVersion(Request $request)
    {
        $nIdVersionVeh      = $request->nIdVersionVeh;
        $nIdVersionVeh      = ($nIdVersionVeh == NULL) ? ($nIdVersionVeh = 0) : $nIdVersionVeh;

        $data = DB::select('exec [usp_Version_SetEliminarXMLByVersion] ?',
                                                [   $nIdVersionVeh
                                                ]);
        return response()->json($data);
    }

    public function SetRegistrarXMLByVersion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();

            //================ FILAS XML =======================
            $arrayXML = $request->data;
            foreach($arrayXML as $ep=>$det)
            {
                $nidversionveh      =   ($det['nidversionveh'] == NULL)  ? ($det['nidversionveh'] = 0) : $det['nidversionveh'];
                $ncabecera          =   ($det['ncabecera'] == NULL)  ? ($det['ncabecera'] = '') : $det['ncabecera'];
                $ncabeceraparent    =   ($det['ncabeceraparent'] == NULL)  ? ($det['ncabeceraparent'] = '') : $det['ncabeceraparent'];
                $ntipofila          =   ($det['ntipofila'] == NULL)  ? ($det['ntipofila'] = 0) : $det['ntipofila'];
                $ccampo             =   ($det['cdescripcion'] == NULL)  ? ($det['cdescripcion'] = '') : $det['cdescripcion'];
                $cvalor             =   ($det['cvalor'] == NULL)  ? ($det['cvalor'] = '') : $det['cvalor'];

                /*
                return [
                    'nidversionveh'     =>  $nidversionveh,
                    'ncabecera'         =>  $ncabecera,
                    'ncabeceraparent'   =>  $ncabeceraparent,
                    'ntipofila'         =>  $ntipofila,
                    'ccampo'            =>  $ccampo,
                    'cvalor'            =>  $cvalor,
                ];*/

                $data =  DB::select('exec [usp_Version_SetRegistrarXML] ?, ?, ?, ?, ?, ?, ?',
                                                                    [
                                                                        $nidversionveh,
                                                                        $ncabecera,
                                                                        $ncabeceraparent,
                                                                        $ccampo,
                                                                        $cvalor,
                                                                        $ntipofila,
                                                                        Auth::user()->id
                                                                    ]);
            }

            DB::commit();
            return response()->json($data);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function GetXMLByVersion(Request $request)
    {
        $nIdVersionVeh      = $request->nIdVersionVeh;
        $nIdVersionVeh      = ($nIdVersionVeh == NULL) ? ($nIdVersionVeh = 0) : $nIdVersionVeh;

        $data = DB::select('exec [usp_Version_GetXMLByVersion] ?',
                                                [   $nIdVersionVeh
                                                ]);
        return response()->json($data);
    }
}

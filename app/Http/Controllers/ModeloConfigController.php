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
        $nIdEmpresa         = $request->nIdEmpresa;
        $nIdProveedor       = $request->nIdProveedor;
        $nIdLinea           = $request->nIdLinea;
        $nIdMarca           = $request->nIdMarca;
        $nIdModelo          = $request->nIdModelo;
        $cNombreComercial   = $request->cNombreComercial;

        $nIdEmpresa         = ($nIdEmpresa == NULL) ? ($nIdEmpresa = 0) : $nIdEmpresa;
        $nIdProveedor       = ($nIdProveedor == NULL) ? ($nIdProveedor = 0) : $nIdProveedor;
        $nIdLinea           = ($nIdLinea == NULL) ? ($nIdLinea = 0) : $nIdLinea;
        $nIdMarca           = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo          = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $cNombreComercial      = ($cNombreComercial == NULL) ? ($cNombreComercial = '') : $cNombreComercial;

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
            $cNombreComercial       =   $request->cnombrecomercial;
            $nIdUsuario             =   Auth::user()->id;

            $fileFotografia         =   ($fileFotografia == NULL)  ? ($fileFotografia = '') : $fileFotografia;
            $fileFichaTecnica       =   ($fileFichaTecnica == NULL)  ? ($fileFichaTecnica = '') : $fileFichaTecnica;
            $fileFichaTecnicaPDF    =   ($fileFichaTecnicaPDF == NULL)  ? ($fileFichaTecnicaPDF = '') : $fileFichaTecnicaPDF;
            $nIdModelo              =   ($nIdModelo == NULL)  ? ($nIdModelo = 0) : $nIdModelo;
            $nAnioModelo            =   ($nAnioModelo == NULL) ? ($nAnioModelo = 0) : $nAnioModelo;
            $cNombreComercial       =   ($cNombreComercial == NULL) ? ($cNombreComercial = 0) : $cNombreComercial;

            //VERIFICO SI EXISTE ARCHIVO
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
                                                                $cNombreComercial,
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
        $cNombreComercial   = $request->cnombrecomercial;

        $nIdModelo          = ($nIdModelo == NULL)  ? ($nIdModelo = 0) : $nIdModelo;
        $nAnioModelo        = ($nAnioModelo == NULL) ? ($nAnioModelo = 0) : $nAnioModelo;
        $cNombreComercial   = ($cNombreComercial == NULL) ? ($cNombreComercial = 0) : $cNombreComercial;

        $data = DB::select('exec [usp_Modelo_GetInfoDocsModelo] ?, ?, ?',
                                                [   $nIdModelo,
                                                    $nAnioModelo,
                                                    $cNombreComercial
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
            $cNombreComercial       =   $request->cnombrecomercial;
            $nIdUsuario             =   Auth::user()->id;

            $fileFotografia         =   ($fileFotografia == NULL)  ? ($fileFotografia = '') : $fileFotografia;
            $fileFichaTecnica       =   ($fileFichaTecnica == NULL)  ? ($fileFichaTecnica = '') : $fileFichaTecnica;
            $fileFichaTecnicaPDF    =   ($fileFichaTecnicaPDF == NULL)  ? ($fileFichaTecnicaPDF = '') : $fileFichaTecnicaPDF;
            $nIdModelo              =   ($nIdModelo == NULL)  ? ($nIdModelo = 0) : $nIdModelo;
            $nAnioModelo            =   ($nAnioModelo == NULL) ? ($nAnioModelo = 0) : $nAnioModelo;
            $cNombreComercial       =   ($cNombreComercial == NULL) ? ($cNombreComercial = 0) : $cNombreComercial;

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
                                                                $cNombreComercial,
                                                                $nIdUsuario
                                                            ]);
            DB::commit();
            return response()->json($data);
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}

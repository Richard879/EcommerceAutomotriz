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
        $cNombreModelo      = $request->cNombreModelo;

        $nIdEmpresa         = ($nIdEmpresa == NULL) ? ($nIdEmpresa = 0) : $nIdEmpresa;
        $nIdProveedor       = ($nIdProveedor == NULL) ? ($nIdProveedor = 0) : $nIdProveedor;
        $nIdLinea           = ($nIdLinea == NULL) ? ($nIdLinea = 0) : $nIdLinea;
        $nIdMarca           = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo          = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $cNombreModelo      = ($cNombreModelo == NULL) ? ($cNombreModelo = '') : $cNombreModelo;

        $data = DB::select('exec [usp_Modelo_GetListModelosByAnioModelo] ?, ?, ?, ?, ?, ?',
                                                [   $nIdEmpresa,
                                                    $nIdProveedor,
                                                    $nIdLinea,
                                                    $nIdMarca,
                                                    $nIdModelo,
                                                    $cNombreModelo
                                                ]);

        $arrayListModelos = ParametroController::arrayPaginator($data, $request);
        return ['arrayListModelos'=>$arrayListModelos];
    }

    public function SetRegistrarDocs(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $fileFotografia     =   $request->fileFotografia;
            $fileFichaTecnica   =   $request->fileFichaTecnica;
            $nIdModelo          =   $request->nidmodelo;
            $nAnioModelo        =   $request->naniomodelo;
            $nIdUsuario         =   Auth::user()->id;

            $fileFotografia     =   ($fileFotografia == NULL)  ? ($fileFotografia = '') : $fileFotografia;
            $fileFichaTecnica   =   ($fileFichaTecnica == NULL)  ? ($fileFichaTecnica = '') : $fileFichaTecnica;
            $nIdModelo          =   ($nIdModelo == NULL)  ? ($nIdModelo = 0) : $nIdModelo;
            $nAnioModelo        =   ($nAnioModelo == NULL) ? ($nAnioModelo = 0) : $nAnioModelo;

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
                $nombreArchivoServidorFicha = $banderaFicha .'_'. $fileFichaTecnica->getClientOriginalName();
                //Almaceno el archivo en un ruta especifica
                $ruta = Storage::putFileAs('public/ModeloAnio/Ficha/', $fileFichaTecnica, $nombreArchivoServidorFicha);
            }
            //GUARDO LA RUTA DEL ARCHIVO SI EXISTE
            $pcNombreRutaFichaTecnica = ($fileFichaTecnica) ? (asset('storage/ModeloAnio/Ficha/' . $nombreArchivoServidorFicha)) : '';

            $data = DB::select('exec usp_Modelo_SetRegistrarModeloDocs ?, ?, ?, ?, ?',
                                                            [
                                                                $pcNombreRutaFotografia,
                                                                $pcNombreRutaFichaTecnica,
                                                                $nIdModelo,
                                                                $nAnioModelo,
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
        $nIdModelo      = $request->nidmodelo;
        $nAnioModelo    = $request->naniomodelo;

        $nIdModelo      = ($nIdModelo == NULL)  ? ($nIdModelo = 0) : $nIdModelo;
        $nAnioModelo    = ($nAnioModelo == NULL) ? ($nAnioModelo = 0) : $nAnioModelo;

        $data = DB::select('exec [usp_Modelo_GetInfoDocsModelo] ?, ?',
                                                [   $nIdModelo,
                                                    $nAnioModelo
                                                ]);

        return response()->json($data);
    }

    public function SetActualizarDocs(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $fileFotografia     =   $request->fileFotografia;
            $fileFichaTecnica   =   $request->fileFichaTecnica;
            $nIdModelo          =   $request->nidmodelo;
            $nAnioModelo        =   $request->naniomodelo;
            $nIdUsuario         =   Auth::user()->id;

            $fileFotografia     =   ($fileFotografia == NULL)  ? ($fileFotografia = '') : $fileFotografia;
            $fileFichaTecnica   =   ($fileFichaTecnica == NULL)  ? ($fileFichaTecnica = '') : $fileFichaTecnica;
            $nIdModelo          =   ($nIdModelo == NULL)  ? ($nIdModelo = 0) : $nIdModelo;
            $nAnioModelo        =   ($nAnioModelo == NULL) ? ($nAnioModelo = 0) : $nAnioModelo;

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
                $nombreArchivoServidorFicha = $banderaFicha .'_'. $fileFichaTecnica->getClientOriginalName();
                //Almaceno el archivo en un ruta especifica
                $ruta = Storage::putFileAs('public/ModeloAnio/Ficha/', $fileFichaTecnica, $nombreArchivoServidorFicha);
            }
            //GUARDO LA RUTA DEL ARCHIVO SI EXISTE
            $pcNombreRutaFichaTecnica = ($fileFichaTecnica) ? (asset('storage/ModeloAnio/Ficha/' . $nombreArchivoServidorFicha)) : '';

            $data = DB::select('exec usp_Modelo_SetActualizarModeloDocs ?, ?, ?, ?, ?',
                                                            [
                                                                $pcNombreRutaFotografia,
                                                                $pcNombreRutaFichaTecnica,
                                                                $nIdModelo,
                                                                $nAnioModelo,
                                                                $nIdUsuario
                                                            ]);
            DB::commit();
            return response()->json($data);
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}

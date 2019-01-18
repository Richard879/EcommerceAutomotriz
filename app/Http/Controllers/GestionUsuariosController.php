<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class GestionUsuariosController extends Controller
{
    public function GetListUsuarios(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $cDescripcion = $request->cdescripcion;

        $opcion = $request->opcion;

        $cDescripcion = ($cDescripcion == NULL) ? ($cDescripcion = '') : $cDescripcion;

        $arrayUsuarios = DB::select('exec usp_Usuario_GetListUsuarios ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $cDescripcion
                                                            ]);

        if($opcion == 1) {
            $arrayUsuarios = ParametroController::arrayPaginator($arrayUsuarios, $request);
            return ['arrayUsuarios'=>$arrayUsuarios];
        } else {
            return response()->json($arrayUsuarios);
        }
    }

    public function GetListRoles(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayRoles = DB::select('exec usp_Usuario_GetListRoles');

        return response()->json($arrayRoles);
    }

    public function SetRegistrarUsuario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $file           =   $request->file;
            $nIdEmpresa     =   $request->nidempresa;
            $nIdSucursal    =   $request->nidsucursal;
            $cNombreC       =   $request->cnombrecompleto;
            $cusuario       =   $request->cusuario;
            $cpassword      =   bcrypt($request->cpassword);
            $nrol           =   $request->nrol;
            $nIdUsuario     =   Auth::user()->id;

            if($file) {
                $bandera = str_random(10);
                $nombreArchivoServidor = $bandera .'_'. $file->getClientOriginalName();
                //Almaceno el archivo en un ruta especifica
                $ruta = Storage::putFileAs('public/Usuario', $file, $nombreArchivoServidor);
            }

            $pcNombreRuta = ($file) ? (asset('storage/Usuario/' . $nombreArchivoServidor)) : '';

            $usuario = DB::select('exec usp_Usuario_SetRegistrarUsuario ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $cNombreC,
                                                                $cusuario,
                                                                $cpassword,
                                                                $nrol,
                                                                $pcNombreRuta,
                                                                $nIdUsuario
                                                            ]);

            DB::commit();
            return response()->json($usuario);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetListPermisosByRol(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nrol = $request->nrol;

        $arrayPermisosbyRol = DB::select('exec usp_Usuario_GetListPermisosByRol',
                                                        [
                                                            $nrol
                                                        ]);

        return response()->json($arrayPermisosbyRol);
    }
}

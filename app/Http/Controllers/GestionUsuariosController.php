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

        $arrayPermisosbyRol = DB::select('exec usp_Usuario_GetListPermisosByRol ?',
                                                        [
                                                            $nrol
                                                        ]);

        return response()->json($arrayPermisosbyRol);
    }

    public function SetPermisosByUsuario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $nIdEmpresa     =   $request->nIdEmpresa;
            $nIdSucursal    =   $request->nIdSucursal;
            $nIdUsuario     =   $request->nIdUsuario;
            $nIdPerfil      =   $request->nIdPerfil;
            $nIdUsuarioAuth =   Auth::user()->id;

            $nIdEmpresa = ($nIdEmpresa == NULL) ? ($nIdEmpresa = 0) : $nIdEmpresa;
            $nIdSucursal = ($nIdSucursal == NULL) ? ($nIdSucursal = 0) : $nIdSucursal;

            //REGISTRAR RELACIÓN DEL USUARIO CON LA EMPRESA/SUCURSAL
            DB::select('EXEC usp_Usuario_SetRelacionByUsuario ?, ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $nIdUsuario,
                                        $nIdUsuarioAuth
                                    ]);

            $detalles = $request->arrayData;
            foreach($detalles as $ep=>$det)
            {
                //REGISTRAR PERMISOS DEL USUARIO
                $data = DB::select('exec usp_Usuario_SetPermisosByUsuario ?, ?, ?, ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdUsuario,
                                                                $nIdPerfil,
                                                                $det['nIdMenu'],
                                                                $nIdUsuarioAuth
                                                            ]);
            }
            DB::commit();
            return response()->json($data);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetInformacionUsuario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdUsuario =   Auth::user()->id;
        $dFecha = $request->dfecha;

        $dFecha = ($dFecha == NULL) ? ($dFecha = '') : $dFecha;

        $usuario = DB::select('exec usp_Usuario_GetInformacionUsuario ?',
                                                    [
                                                        $nIdUsuario
                                                    ]);

        $tipocambio = DB::select('exec [usp_TipoCambio_GetTipoCambioByFecha] ?',
                                                                [   $dFecha
                                                                ]);

        $flag = 0;
        if ($tipocambio[0]->fValorTipoCambioComercial > 0) {
            $flag = 1;
        } else {
            $flag = 0;
        }

        $data = [
            'flag'          =>  $flag,
            'usuario'       =>  $usuario,
            'tipocambio'    =>  $tipocambio
        ];

        return response()->json($data);
    }

    public function GetInformacionUsuarioCabecera(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdUsuario =   Auth::user()->id;

        $usuario = DB::select('exec usp_Usuario_GetInformacionUsuario ?',
                                                    [
                                                        $nIdUsuario
                                                    ]);
        return response()->json($usuario);
    }

    public function SetCambiarEstadoUsuario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $currentUser    =   Auth::user()->id;//Usuario Actual
        $nIdUsuario     =   $request->nIdUsuario;//Usuario Seleccionado

        $condicion  = ($request->opcion == 0) ? ($condicion = '0') : ($condicion = '1');
        $estado     = ($request->opcion == 0) ? ($estado = 'D') : ($estado = 'A');

        $usuario = DB::select('exec usp_Usuario_SetCambiarEstadoUsuario ?, ?, ?',
                                                    [
                                                        $nIdUsuario,
                                                        $condicion,
                                                        $estado
                                                    ]);

        return response()->json($usuario);
    }
}

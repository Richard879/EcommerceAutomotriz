<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Events\LogoutFromEveryWhere;

class GestionUsuariosController extends Controller
{
    public function GetListUsuarios(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     =   $request->nidempresa;
        $nIdSucursal    =   $request->nidsucursal;
        $nIdRol         =   $request->nidrol;
        $cDescripcion   =   $request->cdescripcion;

        $opcion = $request->opcion;

        $nIdRol         = ($nIdRol == NULL) ? ($nIdRol = 0) : $nIdRol;
        $cDescripcion   = ($cDescripcion == NULL) ? ($cDescripcion = '') : $cDescripcion;

        $arrayUsuarios = DB::select('exec usp_Usuario_GetListUsuarios ?, ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdRol,
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

        $cnombre = $request->cnombre;
        $cnombre = ($cnombre == NULL) ? ($cnombre = '') : $cnombre;

        $arrayRoles = DB::select('exec usp_Usuario_GetListRoles ?',
                                                        [
                                                            $cnombre
                                                        ]);

        return response()->json($arrayRoles);
    }

    public function GetListRolesBsq(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidrol = $request->nidrol;
        $nidrol = ($nidrol == NULL) ? ($nidrol = 0) : $nidrol;

        $arrayRoles = DB::select('exec usp_Usuario_GetListRolesBsq ?',
                                                        [
                                                            $nidrol
                                                        ]);

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

    public function SetEditarUsuario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $file           =   $request->file;
            $nIdEmpleado    =   $request->nidusuario;
            $nIdEmpresa     =   $request->nidempresa;
            $nIdSucursal    =   $request->nidsucursal;
            $cNombreC       =   $request->cnombrecompleto;
            $cusuario       =   $request->cusuario;
            $cpassword      =   ($request->cpassword == null) ? '' : bcrypt($request->cpassword);
            $nrol           =   $request->nrol;
            $nIdUsuario     =   Auth::user()->id;

            if($file) {
                $bandera = str_random(10);
                $nombreArchivoServidor = $bandera .'_'. $file->getClientOriginalName();
                //Almaceno el archivo en un ruta especifica
                $ruta = Storage::putFileAs('public/Usuario', $file, $nombreArchivoServidor);
            }

            $pcNombreRuta = ($file) ? (asset('storage/Usuario/' . $nombreArchivoServidor)) : '';

            $usuario = DB::select('exec usp_Usuario_SetEditarUsuario ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdEmpleado,
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

    public function SetEliminarPermisosByUsuario(Request $request)
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
            $data = DB::select('EXEC usp_Usuario_SetEliminarPermisosByUsuario ?, ?, ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $nIdUsuario,
                                        $nIdPerfil,
                                        $nIdUsuarioAuth
                                    ]);

            DB::commit();
            return response()->json($data);
        } catch (Exception $e){
            DB::rollBack();
        }
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

        $usuario = DB::select('exec usp_Usuario_SetCambiarEstadoUsuario ?, ?, ?, ?',
                                                    [
                                                        $nIdUsuario,
                                                        $condicion,
                                                        $estado,
                                                        $currentUser
                                                    ]);

        // Si el Usuario ha sido desactivado
        if($request->opcion == 0) {
            // remueve todas las sesiones realacionas al usuario actual
            app('db')->table('sessions')
                    ->where('user_id', $nIdUsuario)
                    ->delete();

            //Obtener el Objeto del Usuario a desactivar
            $userToLogout = User::find($nIdUsuario);

            broadcast(new LogoutFromEveryWhere($userToLogout));
            // event(new LogoutFromEveryWhere($userToLogout));
        }

        return response()->json($usuario);
    }
}

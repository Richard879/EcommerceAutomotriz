<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class EntregaVehiculoController extends Controller
{
    public function arrayPaginator($array, $request)
    {
        $page = $request->page;
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        $array = new Collection($array);
        $result = $array->forPage($page, $perPage)->values()->all();
        return  new LengthAwarePaginator($result, $array->count(), $perPage,$page);
    }

    public function GetLstInspecciones(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa  = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdVehiculo  = $request->nidvehiculo;
        $dFechaSolicitud  = $request->dfechaSolicitud;
        $cFlagEstado  = $request->nidestado;

        $nIdVehiculo  = ($nIdVehiculo == NULL) ? ($nIdVehiculo = 0) : $nIdVehiculo;
        $dFechaSolicitud  = ($dFechaSolicitud == NULL) ? ($dFechaSolicitud = '') : $dFechaSolicitud;
        $cFlagEstado  = ($cFlagEstado == NULL) ? ($cFlagEstado = '') : $cFlagEstado;

        $arrayInspeccionesAprobadas = DB::select('exec usp_EntregaVehiculo_GetLstInspecciones ?, ?, ?, ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdVehiculo,
                                                                $dFechaSolicitud,
                                                                $cFlagEstado,
                                                                Auth::user()->id
                                                            ]);

        $arrayInspeccionesAprobadas = $this->arrayPaginator($arrayInspeccionesAprobadas, $request);
        return ['arrayInspeccionesAprobadas'=>$arrayInspeccionesAprobadas];
    }

    public function SetGenerarEntregaVehículo(Request $request)
    {
        // print_r($request->file('files'));
        // foreach($request->file('files') as $file) {
        //     print_r($file->getClientOriginalName());
        // }
        // return 1;

        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $nIdCabeceraInspeccion  = $request->nIdCabeceraInspeccion;
            $dfechaEntrega      =   $request->dfechaEntrega;
            $cHoraEntrega       =   $request->cHoraEntrega;
            $nIdPersonaRecibe   =   $request->nIdPersonaRecibe;
            $fConforme          =   $request->fConforme;
            $fFacebook          =   $request->fFacebook;
            //Genero la Entrega de Vehículo
            $data = DB::select('exec usp_EntregaVehiculo_SetGenerarEntregaVehículo ?, ?, ?, ?, ?, ?, ?',
                                                                [
                                                                    $nIdCabeceraInspeccion,
                                                                    $dfechaEntrega,
                                                                    $cHoraEntrega,
                                                                    $nIdPersonaRecibe,
                                                                    $fConforme,
                                                                    $fFacebook,
                                                                    Auth::user()->id
                                                                ]);
            //Captura el nIdEntregaVehiculo
            $nIdEntregaVehiculo =  $data[0]->nIdEntregaVehiculo;

            //Recorro todos los archivos
            //$request->files
            foreach($request->file('files') as $file){
                if($file){
                    $bandera = str_random(10);
                    $nombreArchivoServidor = $bandera .'_'. $file->getClientOriginalName();
                    //Almaceno el archivo en un ruta especifica
                    $ruta = Storage::putFileAs('public/EntregaVehiculo', $file, $nombreArchivoServidor);
                    //Guarda el Documento Adjunto
                    $arrayDocumento = DB::select('exec usp_EntregaVehiculo_SetDocumentoAdjunto ?, ?, ?',
                                                                            [   asset('storage/EntregaVehiculo/' . $nombreArchivoServidor),
                                                                                $file->getClientOriginalName(),
                                                                                Auth::user()->id
                                                                            ]);
                    //Capturo el nIdDocumentoAdjunto
                    $nIdDocumentoAdjunto =  $arrayDocumento[0]->nIdDocumentoAdjunto;
                    //Guarda el Detalle de documentos adjuntos
                    DB::select('exec usp_EntregaVehiculo_SetDocumentoAdjuntoEntregaVehiculo ?, ?, ?',
                                                                            [   $nIdEntregaVehiculo,
                                                                                $nIdDocumentoAdjunto,
                                                                                Auth::user()->id
                                                                            ]);
                }
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetLstArchivosAdjuntos(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEntregaVehiculo  = $request->nIdEntregaVehiculo;

        $nIdEntregaVehiculo  = ($nIdEntregaVehiculo == NULL) ? ($nIdEntregaVehiculo = 0) : $nIdEntregaVehiculo;

        $arrayArchivosAdjuntos = DB::select('exec usp_EntregaVehiculo_GetLstArchivosAdjuntos ?, ?',
                                                            [
                                                                $nIdEntregaVehiculo,
                                                                Auth::user()->id
                                                            ]);

        return response()->json($arrayArchivosAdjuntos);
    }
}

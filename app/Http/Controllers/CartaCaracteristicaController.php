<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CartaCaracteristicaController extends Controller
{
    public function GeLstCompras(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa  = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $cNumeroVin  = $request->cnumberovin;
        $cNumeroVin  = ($cNumeroVin == NULL) ? ($cNumeroVin = ' ') : $cNumeroVin;

        $arrayCompra = DB::select('exec usp_CartaCaracteristica_GetListCompras ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $cNumeroVin
                                                            ]);

        $arrayCompra = ParametroController::arrayPaginator($arrayCompra, $request);
        return ['arrayCompra'=>$arrayCompra];
    }

    public function GetLstCotizacionAprobadas(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCronograma = $request->nidcronograma;
        $nTipoPersona = $request->ntipopersona;
        $cNroDocumento = $request->cnrodocumento;
        $cFiltroDescripcion = $request->cfiltrodescripcion;
        $nIdVendedor = $request->nidvendedor;

        if($request->tipoRol == 1) {
            $nIdVendedor = Auth::user()->id;
        } else {
            $nIdVendedor = 0;
        }

        $cNroDocumento = ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cFiltroDescripcion = ($cFiltroDescripcion == NULL) ? ($cFiltroDescripcion = ' ') : $cFiltroDescripcion;

        $arrayContactosByCotizacionAprobada = DB::select('exec usp_CartaCaracteristica_GetLstCotizacionAprobadas ?, ?, ?, ?, ?, ?, ?',
                                                                        array(  $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $nIdCronograma,
                                                                                $nTipoPersona,
                                                                                $cNroDocumento,
                                                                                $cFiltroDescripcion,
                                                                                $nIdVendedor
                                                                                ));

        $arrayContactosByCotizacionAprobada = ParametroController::arrayPaginator($arrayContactosByCotizacionAprobada, $request);
        return ['arrayContactosByCotizacionAprobada'=>$arrayContactosByCotizacionAprobada];
    }

    public function SetRegistrarSCC(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $data = DB::select('exec usp_CartaCaracteristica_SetRegistrarSCC ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $request->cNumeroCarta,
                                        $request->cAtencion,
                                        $request->nIdRef,
                                        $request->dFechaInicio,
                                        $request->dFechaVencimiento,
                                        $request->nIdCompra,
                                        $request->nIdContacto,
                                        $request->fPrecioFinalDolar,
                                        $request->fCuotaInicial,
                                        $request->fMontoDesembolsado,
                                        $request->nIdBanco,
                                        $request->nIdEstadoCarta,
                                        $request->FlagEstadoApro,
                                        Auth::user()->id
                                    ]);
        //OBTENGO EL ID DE LA SCC
        $nIdSolicitudCartaCaracteristica =  $data[0]->nIdSolicitudCartaCaracteristica;

        return response()->json($nIdSolicitudCartaCaracteristica);
    }

    public function GetLstCartaCaracteristica(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $cNumeroVin = $request->cNumeroVin;
        $nIdContacto = $request->nIdContacto;
        $dFechaInicio = $request->dFechaInicio;
        $dFechaFin = $request->dFechaFin;
        $nIdEstado = $request->nIdEstado;
        $nTipoRol = $request->tipoRol;
        $cFlagEstado = $request->flagEstado;
        $nIdVendedor = $request->nIdVendedor;

        switch ($nTipoRol) {
            case 1:
                $nIdVendedor = Auth::user()->id;
                break;
            case 21:
                $nIdVendedor = ($nIdVendedor == null) ? 0 : $nIdVendedor;
                break;
            case 22:
                $nIdVendedor = Auth::user()->id;
                break;
            default:
                $nIdVendedor = 0;
                break;
        }

        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = ' ') : $cNumeroVin;
        $nIdContacto = ($nIdContacto == NULL) ? ($nIdContacto = 0) : $nIdContacto;
        $dFechaInicio = ($dFechaInicio == NULL) ? ($dFechaInicio = ' ') : $dFechaInicio;
        $dFechaFin = ($dFechaFin == NULL) ? ($dFechaFin = ' ') : $dFechaFin;
        $nIdEstado = ($nIdEstado == NULL) ? ($nIdEstado = 0) : $nIdEstado;
        $cFlagEstado = ($cFlagEstado == NULL) ? ($cFlagEstado = ' ') : $cFlagEstado;

        $arrayCartaCaracteristicas = DB::select('exec usp_CartaCaracteristica_GetLstCartaCaracteristica ?, ?, ?, ?, ?, ?, ?, ?',
                                                                        [
                                                                            $cNumeroVin,
                                                                            $nIdContacto,
                                                                            $dFechaInicio,
                                                                            $dFechaFin,
                                                                            $nIdEstado,
                                                                            $nTipoRol,
                                                                            $cFlagEstado,
                                                                            $nIdVendedor
                                                                        ]);

        $arrayCartaCaracteristicas = ParametroController::arrayPaginator($arrayCartaCaracteristicas, $request);
        return ['arrayCartaCaracteristicas'=>$arrayCartaCaracteristicas];
    }

    public function GetDetalleSolicitud(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $data = DB::select('exec usp_CartaCaracteristica_GetDetalleSolicitud ?', [$request->nIdScartaC]);

        return response()->json($data);
    }

    public function SetConformeNoConforme(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdScartaC = $request->nIdScartaC;
        $nIdEstadoCarta = $request->nIdEstadoCarta;
        $FlagEstadoApro = $request->FlagEstadoApro;

        $data = DB::select('exec usp_CartaCaracteristica_SetCambiarEstado ?, ?, ?, ?, ?',
                                                [
                                                    $nIdScartaC,
                                                    $nIdEstadoCarta,
                                                    $FlagEstadoApro,
                                                    null,
                                                    null
                                                ]);

        $lstSCC = DB::select('exec usp_CartaCaracteristica_GetDetalleSolicitud ?', [$nIdScartaC]);

        $ruta = Storage::makeDirectory('public/CartaCaracteristica/conformeNOconforme');//CONSTRUYO EL DIRECTORIO DINAMICAMENTE
        $bandera = str_random(10);//RANDOM 10 ALPHA NÚMERICO
        $nombrePDFOriginal  = $request->nombre . '.pdf';//NOMBRE ORIGINAL DEL ARCHIVO
        $nombrePDFToken     = $bandera .'_'. $nombrePDFOriginal;//NOMBRE ORIGINAL DEL ARCHIVO + TOKEN
        $path = storage_path("app/public/CartaCaracteristica/conformeNOconforme/{$nombrePDFToken}");//CAPTURO LA RUTA DEL DIRECTORIO + NOMBRE DEL ARCHIVO
        $pdf = \PDF::loadView('pdf.solicitudcartacaracteristica.detallesolicitud', ['CartaDetalleSolicitud' => $lstSCC])->save($path);//ALMACENO EL ARCHIVO EN EL SERVIDOR

        //REGISTRO EN LA DB LA RUTA, NOMBRE Y USUARIO
        $arrayDocumento = DB::select('exec usp_Pedido_SetDocumentoAdjunto ?, ?, ?',
                                                        [
                                                            asset('storage/CartaCaracteristica/conformeNOconforme/'. $nombrePDFToken),
                                                            $nombrePDFOriginal,
                                                            Auth::user()->id
                                                        ]);
        //OBTENGO EL ID DEL DOCUMENTO GUARDADO
        $nIdDocumentoAdjunto =  $arrayDocumento[0]->nIdDocumentoAdjunto;
        //ACTUALIZO EL ID EN LA TABLA SCC
        DB::select('exec usp_CartaCaracteristica_SetIdDocumentoAdjunto ?, ?', [$nIdScartaC, $nIdDocumentoAdjunto]);
    }

    public function SetAprobadoNoAprobado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $file = $request->file;
        $nIdScartaC = $request->nIdScartaC;
        $nIdEstadoCarta = $request->nIdEstadoCarta;
        $FlagEstadoApro = $request->FlagEstadoApro;

        $data = DB::select('exec usp_CartaCaracteristica_SetCambiarEstado ?, ?, ?, ?, ?',
                                                [
                                                    $nIdScartaC,
                                                    $nIdEstadoCarta,
                                                    $FlagEstadoApro,
                                                    null,
                                                    null
                                                ]);

        $lstSCC = DB::select('exec usp_CartaCaracteristica_GetDetalleSolicitud ?', [$nIdScartaC]);

        $bandera = str_random(10);//RANDOM 10 ALPHA NÚMERICO
        $pathStorageImagen = Storage::putFileAs('public/CartaCaracteristica/aprobadoNOaprobado', $file, $bandera .'_'. $file->getClientOriginalName());//ALMACENO LA IMAGEN EN EL SERVIDOR
        $basePath = public_path('storage/CartaCaracteristica/aprobadoNOaprobado/' . ($bandera .'_'. $file->getClientOriginalName()));//CAPTURO LA RUTA COMPLETA DE LA IMAGEN, PARA MOSTRARLA EN EL PDF

        $ruta = Storage::makeDirectory('public/CartaCaracteristica/aprobadoNOaprobado');//CONSTRUYO EL DIRECTORIO DINAMICAMENTE
        $nombrePDFOriginal  = $request->nombre . '.pdf';//NOMBRE ORIGINAL DEL ARCHIVO
        $nombrePDFToken     = $bandera .'_'. $nombrePDFOriginal;//NOMBRE ORIGINAL DEL ARCHIVO + TOKEN
        $pathPDF = storage_path("app/public/CartaCaracteristica/aprobadoNOaprobado/{$nombrePDFToken}");//CAPTURO LA RUTA DEL DIRECTORIO + NOMBRE DEL ARCHIVO
        $pdf = \PDF::loadView('pdf.solicitudcartacaracteristica.aprobacionsolicitud', ['CartaDetalleSolicitud' => $lstSCC, 'imagen' => $basePath])->save($pathPDF);//ALMACENO EL PDF EN EL SERVIDOR


        //REGISTRO EN LA DB LA RUTA, NOMBRE Y USUARIO
        $arrayDocumento = DB::select('exec usp_Pedido_SetDocumentoAdjunto ?, ?, ?',
                                                        [
                                                            //asset => http://localhost:8080/saisacsys/public/
                                                            asset('storage/CartaCaracteristica/aprobadoNOaprobado/'. $nombrePDFToken),
                                                            $nombrePDFOriginal,
                                                            Auth::user()->id
                                                        ]);
        //OBTENGO EL ID DEL DOCUMENTO GUARDADO
        $nIdDocumentoAdjunto =  $arrayDocumento[0]->nIdDocumentoAdjunto;
        //ACTUALIZO EL ID EN LA TABLA SCC
        DB::select('exec usp_CartaCaracteristica_SetIdDocumentoAdjunto ?, ?', [$nIdScartaC, $nIdDocumentoAdjunto]);
    }

    public function SetAnularSCC(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdScartaC = $request->nIdScartaC;
        $nIdEstadoCarta = $request->nIdEstadoCarta;
        $FlagEstadoApro = $request->FlagEstadoApro;
        $nIdMotivo = $request->nIdMotivo;
        $cDescripcion = $request->cDescripcion;

        $data = DB::select('exec usp_CartaCaracteristica_SetCambiarEstado ?, ?, ?, ?, ?',
                                                [
                                                    $nIdScartaC,
                                                    $nIdEstadoCarta,
                                                    $FlagEstadoApro,
                                                    $nIdMotivo,
                                                    $cDescripcion
                                                ]);

    }
}

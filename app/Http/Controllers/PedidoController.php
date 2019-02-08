<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function GetLstCotizacionIngresadas(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $dFechaInicio = $request->dfechainicio;
        $dFechaFin = $request->dfechafin;
        $nIdMarca = $request->nidmarca;
        $nIdModelo = $request->nidmodelo;
        $cNumeroCotizacion = $request->cnumerocotizacion;
        $dFechaInicio = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $cNumeroCotizacion = ($cNumeroCotizacion == NULL) ? ($cNumeroCotizacion = '') : $cNumeroCotizacion;

        $arrayPedido = DB::select('exec [usp_Pedido_GetLstCotizacionIngresadas] ?, ?, ?, ?, ?, ?, ?, ?',
                                                            array(  $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $dFechaInicio,
                                                                    $dFechaFin,
                                                                    $nIdMarca,
                                                                    $nIdModelo,
                                                                    $cNumeroCotizacion,
                                                                    Auth::user()->id
                                                                    ));

        $arrayPedido = ParametroController::arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }

    public function GetLstCompraByIdModelo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCabeceraCotizacion = $request->nidcabeceracotizacion;
        $cNumeroVin = $request->cnumerovin;

        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = ' ') : $cNumeroVin;

        $arrayCompra = DB::select('exec [usp_Pedido_GetLstCompraByIdModelo] ?, ?, ?, ?',
                                                            array(  $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $nIdCabeceraCotizacion,
                                                                    $cNumeroVin
                                                                    ));

        $arrayCompra = ParametroController::arrayPaginator($arrayCompra, $request);
        return ['arrayCompra'=>$arrayCompra];
    }

    public function GetListaPrecioDetalleByIdCotizacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCabeceraCotizacion = $request->nidcabeceracotizacion;

        $objListaDetalle = DB::select('exec [usp_Pedido_GetListaPrecioDetalleByIdCotizacion] ?, ?, ?',
                                                                            array(  $nIdEmpresa,
                                                                                    $nIdSucursal,
                                                                                    $nIdCabeceraCotizacion
                                                                                    ));
        return response()->json($objListaDetalle);
    }

    public function GetLstPedidosPendienteAprobacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidempresa    =   $request->nidempresa;
        $nidsucursal   =   $request->nidsucursal;
        $cnumeropedido  =   $request->cnumeropedido;
        $cnumerovin     =   $request->cnumerovin;
        $dfechainicio  =   $request->dfechainicio;
        $dfechafin     =   $request->dfechafin;
        $nidmarca      =   $request->nidmarca;
        $nidmodelo     =   $request->nidmodelo;

        $nidmarca = ($nidmarca == NULL) ? ($nidmarca = 0) : $nidmarca;
        $nidmodelo = ($nidmodelo == NULL) ? ($nidmodelo = 0) : $nidmodelo;
        $dfechainicio = ($dfechainicio == NULL) ? ($dfechainicio = '') : $dfechainicio;
        $dfechafin = ($dfechafin == NULL) ? ($dfechafin = '') : $dfechafin;
        $cnumeropedido = ($cnumeropedido == NULL) ? ($cnumeropedido = '') : $cnumeropedido;
        $cnumerovin = ($cnumerovin == NULL) ? ($cnumerovin = '') : $cnumerovin;

        $arrayPedido = DB::select('exec [usp_Pedido_GetLstPedidosPendienteAprobacion] ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                                    [
                                                                                        $nidempresa,
                                                                                        $nidsucursal,
                                                                                        $dfechainicio,
                                                                                        $dfechafin,
                                                                                        $cnumeropedido,
                                                                                        $cnumerovin,
                                                                                        $nidmarca,
                                                                                        $nidmodelo,
                                                                                        Auth::user()->id
                                                                                    ]);

        $arrayPedido = ParametroController::arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }

    //fluno direcciones
    public function GetDireccionesByPersona(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdPersona    =   $request->nIdPersona;
        $cTipoPersona  =   $request->cTipoPersona;

        $arrayDirecciones = DB::select('exec [usp_Persona_GetDireccionesByPersona] ?, ?',
                                                    [
                                                        $nIdPersona,
                                                        $cTipoPersona
                                                    ]);

        return response()->json($arrayDirecciones);
    }

    public function GetDireccionPersonaByPersona(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdPersona     =   $request->nIdPersona;
        $cTipoPersona   =   $request->cTipoPersona;

        $arrayDireccionPersonaByPersona = DB::select('exec [usp_Persona_GetDireccionPersonaByPersona] ?, ?',
                                                    [
                                                        $nIdPersona,
                                                        $cTipoPersona
                                                    ]);

        return response()->json($arrayDireccionPersonaByPersona);
    }

    public function SetRegistrarDireccionPersona(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $nIdPersona = $request->nIdPersona;

            $arrayDireccionesFiscalesLength = sizeof($request->arrayDireccionesFiscales);
            if($arrayDireccionesFiscalesLength > 0) {
                $arrayDireccionesFiscales = $request->arrayDireccionesFiscales;
                foreach($arrayDireccionesFiscales as $ep=>$det)
                {
                    $infoUbigeo = DB::select('exec [usp_Ubi_GetUbigeoByID] ?',
                                                                [
                                                                    $det['cUbigeo']
                                                                ]);

                    $data = DB::select('exec [usp_Persona_SetDirecciones] ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [
                                                                    $nIdPersona,
                                                                    $det['AddressName'],
                                                                    $det['Street'],
                                                                    'F',
                                                                    $det['cUbigeo'],
                                                                    $infoUbigeo[0]->cU_SYP_DEPA,
                                                                    $infoUbigeo[0]->cU_SYP_PROV,
                                                                    $infoUbigeo[0]->cU_SYP_DIST,
                                                                    Auth::user()->id
                                                                ]);
                }
            }

            $arrayDireccionesDespachoLength = sizeof($request->arrayDireccionesDespacho);
            if($arrayDireccionesDespachoLength > 0) {
                $arrayDireccionesDespacho = $request->arrayDireccionesDespacho;
                foreach($arrayDireccionesDespacho as $ep=>$det)
                {
                    $infoUbigeo = DB::select('exec [usp_Ubi_GetUbigeoByID] ?',
                                                                [
                                                                    $det['cUbigeo']
                                                                ]);

                    $data = DB::select('exec [usp_Persona_SetDirecciones] ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [
                                                                    $nIdPersona,
                                                                    $det['AddressName'],
                                                                    $det['Street'],
                                                                    'D',
                                                                    $det['cUbigeo'],
                                                                    $infoUbigeo[0]->cU_SYP_DEPA,
                                                                    $infoUbigeo[0]->cU_SYP_PROV,
                                                                    $infoUbigeo[0]->cU_SYP_DIST,
                                                                    Auth::user()->id
                                                                ]);
                }
            }

            DB::commit();
            return response()->json($data);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetObtenerTipoPersona(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdContacto    =   $request->nIdContacto;

        $data = DB::select('exec [usp_Contacto_GetObtenerTipoPersona] ?',
                                                    [   $nIdContacto
                                                    ]);
        return response()->json($data);
    }

    public function GetListContactoBySinCarteraMes(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     = $request->nidempresa;
        $nIdSucursal    = $request->nidsucursal;
        $nIdCronograma  = $request->nidcronograma;
        $nTipoPersona   = $request->ntipopersona;
        $nIdContacto    = $request->nIdContacto;

        $arrayContacto = DB::select('exec [usp_Pedido_GetListContactoBySinCarteraMes] ?, ?, ?, ?, ?',
                                                                                [   $nIdEmpresa,
                                                                                    $nIdSucursal,
                                                                                    $nIdCronograma,
                                                                                    $nTipoPersona,
                                                                                    $nIdContacto
                                                                                ]);

        return response()->json($arrayContacto);
    }

    public function SetAprobarPedido(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $nIdCabeceraPedido  =   $request->nidcabecerapedido;

        $arrayPedido = DB::select('exec [usp_Pedido_SetAprobarPedido] ?, ?, ?, ?',
                                                    [   $nIdEmpresa,
                                                        $nIdSucursal,
                                                        $nIdCabeceraPedido,
                                                        Auth::user()->id
                                                    ]);
        return response()->json($arrayPedido);
    }

    public function SetCabeceraPedido(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $arrayPedido = DB::select('exec [usp_Pedido_SetGenerarPedidoByVendedor] ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $request->nIdEmpresa,
                                        $request->nIdSucursal,
                                        $request->nIdCabeceraCotizacion,
                                        $request->nIdCompra,
                                        $request->cNumeroPedido,
                                        $request->dFechaPedido,
                                        $request->nIdFormaPago,
                                        $request->cGlosa,
                                        Auth::user()->id
                                    ]);

            DB::commit();
            return response()->json($arrayPedido);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function subirArchivo(Request $request)
    {
        try{
            DB::beginTransaction();

            $nameFile = $request->file;
            $data = $request->data;

            foreach($nameFile as $key=> $file){

                if($file){

                    $bandera = str_random(10);
                    $nameArchivo = $bandera .'_'. $file->getClientOriginalName();

                    $ruta = Storage::putFileAs('public/Pedido', $file, $nameArchivo);

                    $arrayDocumento = DB::select('exec [usp_Pedido_SetDocumentoAdjunto] ?, ?, ?',
                                                                    [   asset('storage/Pedido/'.$nameArchivo),
                                                                        $file->getClientOriginalName(),
                                                                        Auth::user()->id
                                                                    ]);

                    $nIdDocumentoAdjunto =  $arrayDocumento[0]->nIdDocumentoAdjunto;

                    foreach($data as $datakey=> $valorparametro)
                    {
                        if($datakey == $key)
                        {
                            //print_r($valorparametro['%22cParArchivoNombre%22'].' '.$valorparametro['%22nIdPar%22']);
                            $nIdTablaDocumento = $valorparametro['%22nIdPar%22'];
                            $nIdCabeceraPedido = $valorparametro['%22nIdCabeceraPedido%22'];
                        }

                    }

                    DB::select('exec [usp_Pedido_SetDocumentoAdjuntoPedido] ?, ?, ?, ?',
                                                                        [   $nIdCabeceraPedido,
                                                                            $nIdTablaDocumento,
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

    public function GetListPedidoByTipoEstado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     =   $request->nidempresa;
        $nIdSucursal    =   $request->nidsucursal;
        $dFechaInicio   =   $request->dfechainicio;
        $dFechaFin      =   $request->dfechafin;
        $cNumeroPedido  =   $request->cnumeropedido;
        $cNumeroVin     =   $request->cnumerovin;
        $nIdMarca       =   $request->nidmarca;
        $nIdModelo      =   $request->nidmodelo;
        $nIdEstadoPedido  = $request->nidestadopedido;

        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $nIdEstadoPedido = ($nIdEstadoPedido == NULL) ? ($nIdEstadoPedido = 0) : $nIdEstadoPedido;
        $dFechaInicio = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $cNumeroPedido = ($cNumeroPedido == NULL) ? ($cNumeroPedido = '') : $cNumeroPedido;
        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;

        $arrayPedido = DB::select('exec [usp_Pedido_GetListPedidoByTipoEstado] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                            [
                                                                                $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $dFechaInicio,
                                                                                $dFechaFin,
                                                                                $cNumeroPedido,
                                                                                $cNumeroVin,
                                                                                $nIdMarca,
                                                                                $nIdModelo,
                                                                                $nIdEstadoPedido,
                                                                                Auth::user()->id
                                                                            ]);

        $arrayPedido = ParametroController::arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }

    public function GetListPedidoAprobados(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     =   $request->nidempresa;
        $nIdSucursal    =   $request->nidsucursal;
        $dFechaInicio   =   $request->dfechainicio;
        $dFechaFin      =   $request->dfechafin;
        $cNumeroPedido  =   $request->cnumeropedido;
        $cNumeroVin     =   $request->cnumerovin;
        $nIdMarca       =   $request->nidmarca;
        $nIdModelo      =   $request->nidmodelo;
        $nIdEstadoPedido  = $request->nidestadopedido;

        $dFechaInicio = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $cNumeroPedido = ($cNumeroPedido == NULL) ? ($cNumeroPedido = '') : $cNumeroPedido;
        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;
        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $nIdEstadoPedido = ($nIdEstadoPedido == NULL) ? ($nIdEstadoPedido = 0) : $nIdEstadoPedido;

        $arrayPedido = DB::select('exec [usp_Pedido_GetListPedidoAprobados] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $dFechaInicio,
                                        $dFechaFin,
                                        $cNumeroPedido,
                                        $cNumeroVin,
                                        $nIdMarca,
                                        $nIdModelo,
                                        $nIdEstadoPedido,
                                        Auth::user()->id
                                    ]);

        $arrayPedido = ParametroController::arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }

    public function GetDocumentoByFormaPago(Request $request)
    {
        $nIdFormaPago = $request->nidformapago;
        $variable   = $request->opcion;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayDocumento = DB::select('exec [usp_Pedido_GetDocumentoByFormaPago] ?',
                                                        [   $nIdFormaPago
                                                        ]);
        if($variable == "0"){
            $arrayDocumento = $this->arrayPaginator($arrayDocumento, $request);
        }
        return ['arrayDocumento'=>$arrayDocumento];
    }

    public function GetDocumentosById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     =   $request->nidempresa;
        $nIdSucursal    =   $request->nidsucursal;
        $nIdCabeceraPedido  = $request->nidcabecerapedido;
        $variable   = $request->opcion;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayPedidoDoumento = DB::select('exec [usp_Pedido_GetDocumentosById] ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $nIdCabeceraPedido
                                    ]);
        if($variable == "0"){
            $arrayPedidoDoumento = ParametroController::arrayPaginator($arrayPedidoDoumento, $request);
        }
        return ['arrayPedidoDoumento'=>$arrayPedidoDoumento];
    }

    public function SetAnularPedido(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     =   $request->nidempresa;
        $nIdSucursal    =   $request->nidsucursal;
        $nIdCabeceraPedido  =  $request->nidcabecerapedido;

        $objPedido = DB::select('exec [usp_Pedido_SetAnularPedido] ?, ?, ?, ?',
                                                    [   $nIdEmpresa,
                                                        $nIdSucursal,
                                                        $nIdCabeceraPedido,
                                                        Auth::user()->id
                                                    ]);
        return response()->json($objPedido);
    }

    public function GetLstDetallePedido(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     =   $request->nidempresa;
        $nIdSucursal    =   $request->nidsucursal;
        $nIdCabeceraPedido  = $request->nidcabecerapedido;
        $variable   = $request->opcion;
        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayDetallePedido = DB::select('exec [usp_Pedido_GetLstDetallePedido] ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $nIdCabeceraPedido
                                    ]);
        if($variable == "0"){
            $arrayDetallePedido = ParametroController::arrayPaginator($arrayDetallePedido, $request);
        }
        return ['arrayDetallePedido'=>$arrayDetallePedido];
    }

    public function GetDetallePedido(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nIdEmpresa;
        $nIdSucursal        =   $request->nIdSucursal;
        $nIdCabeceraPedido  =   $request->nIdCabeceraPedido;

        $logo       = public_path('img/automotoresinka.png');//CAPTURO LA RUTA DEL LOGO
        $hyundai    = public_path('img/hyundai.png');//CAPTURO LA RUTA DE HYUNDAI

        $arrayDetallePedido = DB::select('exec [usp_Pedido_GetPdfDetallePedido] ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $nIdCabeceraPedido
                                    ]);

        $arrayPedidoDoumento = DB::select('exec [usp_Pedido_GetDocumentosById] ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $nIdCabeceraPedido
                                    ]);

        $arrayDatosBanco = DB::select('exec [usp_Banco_GetDatosBanco]');

        $pdf = \PDF::loadView('pdf.pedido.pedido', [
                                            'arrayDetallePedido' => $arrayDetallePedido,
                                            'arrayPedidoDoumento' => $arrayPedidoDoumento,
                                            'arrayDatosBanco' => $arrayDatosBanco,
                                            'logo' => $logo,
                                            'hyundai' => $hyundai
                                        ]);

        return $pdf->download('Pedido -'.$nIdCabeceraPedido.'.pdf');
    }

    public function GetListPedidoForDscto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     =   $request->nidempresa;
        $nIdSucursal    =   $request->nidsucursal;
        $dFechaInicio   =   $request->dfechainicio;
        $dFechaFin      =   $request->dfechafin;
        $cNumeroPedido  =   $request->cnumeropedido;
        $cNumeroVin     =   $request->cnumerovin;
        $nIdMarca       =   $request->nidmarca;
        $nIdModelo      =   $request->nidmodelo;
        $nIdEstadoPedido  = $request->nidestadopedido;

        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $nIdEstadoPedido = ($nIdEstadoPedido == NULL) ? ($nIdEstadoPedido = 0) : $nIdEstadoPedido;
        $dFechaInicio = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $cNumeroPedido = ($cNumeroPedido == NULL) ? ($cNumeroPedido = '') : $cNumeroPedido;
        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;

        $arrayPedido = DB::select('exec [usp_Pedido_GetListPedidoForDscto] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                            [
                                                                                $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $dFechaInicio,
                                                                                $dFechaFin,
                                                                                $cNumeroPedido,
                                                                                $cNumeroVin,
                                                                                $nIdMarca,
                                                                                $nIdModelo,
                                                                                $nIdEstadoPedido,
                                                                                Auth::user()->id
                                                                            ]);

        $arrayPedido = ParametroController::arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }

    public function GetListHistorialPedidoDscto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $nIdCabeceraPedido  =   $request->nIdCabeceraPedido;

        $arrayHistorialPedidoDsctos = DB::select('exec [usp_Pedido_GetListHistorialPedidoDscto] ?, ?, ?, ?',
                                                    [   $nIdEmpresa,
                                                        $nIdSucursal,
                                                        $nIdCabeceraPedido,
                                                        Auth::user()->id
                                                    ]);
        return response()->json($arrayHistorialPedidoDsctos);
    }

    public function SetHistorialPedidoDscto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $nIdCabeceraPedido      =   $request->nIdCabeceraPedido;
            $dMontoNuevoDolares     =   $request->dMontoNuevoDolares;
            $dMontoNuevoSoles       =   $request->dMontoNuevoSoles;
            $dMontoDescontarFlag    =   $request->dMontoDescontarFlag;
            $dTipoCambioComercial   =   $request->dTipoCambioComercial;


            $data = DB::select('exec [usp_Pedido_SetHistorialPedidoDscto] ?, ?, ?, ?, ?, ?',
                                                        [   $nIdCabeceraPedido,
                                                            $dMontoNuevoDolares,
                                                            $dMontoNuevoSoles,
                                                            $dMontoDescontarFlag,
                                                            $dTipoCambioComercial,
                                                            Auth::user()->id
                                                        ]);
            DB::commit();
            return response()->json($data);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetPedidoById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $nIdCabeceraPedido  =   $request->nidcabecerapedido;
        $variable           =   $request->opcion;

        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayCabeceraPedido = DB::select('exec [usp_Pedido_GetPedidoById] ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdCabeceraPedido
                                                            ]);
        if($variable == "0"){
            $arrayCabeceraPedido = ParametroController::arrayPaginator($arrayCabeceraPedido, $request);
        }
        return ['arrayCabeceraPedido'=>$arrayCabeceraPedido];
    }

    public function GetPedidoEVById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $nIdCabeceraPedido  =   $request->nidcabecerapedido;
        $variable           =   $request->opcion;

        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayEVPedido = DB::select('exec [usp_Pedido_GetPedidoEVById] ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdCabeceraPedido
                                                            ]);
        if($variable == "0"){
            $arrayEVPedido = ParametroController::arrayPaginator($arrayEVPedido, $request);
        }
        return ['arrayEVPedido'=>$arrayEVPedido];
    }

    public function SapUpdPedidoByDocEntry(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objCompra = DB::select('exec [usp_Integra_SetIntegraDetallePedido] ?, ?, ?, ?, ?, ?, ?',
                                                            [   $det['nIdCabeceraPedido'],
                                                                $det['cItemCode'],
                                                                $det['nDocEntry'],
                                                                $det['nDocNum'],
                                                                $det['cDocType'],
                                                                $det['cLogRespuesta'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($objCompra);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SapUpdFacturaByDocEntry(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $objFactura = DB::select('exec [usp_Pedido_SapUpdComprobanteByDocEntry] ?, ?, ?, ?, ?, ?, ?',
                                                            [   $det['nIdCabeceraPedido'],
                                                                $det['cItemCode'],
                                                                $det['nDocEntry'],
                                                                $det['nDocNum'],
                                                                $det['cDocType'],
                                                                $det['cLogRespuesta'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
            return response()->json($objFactura);
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}

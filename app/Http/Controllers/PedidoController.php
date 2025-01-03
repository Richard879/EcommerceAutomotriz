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

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $dFechaInicio       =   $request->dfechainicio;
        $dFechaFin          =   $request->dfechafin;
        $nIdMarca           =   $request->nidmarca;
        $nIdModelo          =   $request->nidmodelo;
        $cNumeroCotizacion  =   $request->cnumerocotizacion;
        $cContacto          =   $request->ccontacto;
        $cNumeroDocumento   =   $request->cnrodocumento;

        $dFechaInicio       =   ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin          =   ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $nIdMarca           =   ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo          =   ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $cNumeroCotizacion  =   ($cNumeroCotizacion == NULL) ? ($cNumeroCotizacion = '') : $cNumeroCotizacion;
        $cContacto          =   ($cContacto == NULL) ? ($cContacto = '') : $cContacto;
        $cNumeroDocumento   =   ($cNumeroDocumento == NULL) ? ($cNumeroDocumento = '') : $cNumeroDocumento;

        $arrayPedido = DB::select('exec [usp_Pedido_GetLstCotizacionIngresadas] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $dFechaInicio,
                                                                    $dFechaFin,
                                                                    $nIdMarca,
                                                                    $nIdModelo,
                                                                    $cNumeroCotizacion,
                                                                    $cContacto,
                                                                    $cNumeroDocumento,
                                                                    Auth::user()->id
                                                                ]);

        //$arrayPedido = ParametroController::arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }

    public function GetLstCompraByIdModelo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa             =   $request->nidempresa;
        $nIdSucursal            =   $request->nidsucursal;
        $nIdCabeceraCotizacion  =   $request->nidcabeceracotizacion;
        $cNumeroVin             =   $request->cnumerovin;

        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = ' ') : $cNumeroVin;

        $arrayCompra = DB::select('exec [usp_Pedido_GetLstCompraByIdModelo] ?, ?, ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdCabeceraCotizacion,
                                                                $cNumeroVin,
                                                                Auth::user()->id
                                                            ]);

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

        $nidempresa         =   $request->nidempresa;
        $nidsucursal        =   $request->nidsucursal;
        $cnumeropedido      =   $request->cnumeropedido;
        $cnumerovin         =   $request->cnumerovin;
        $dfechainicio       =   $request->dfechainicio;
        $dfechafin          =   $request->dfechafin;
        $nidmarca           =   $request->nidmarca;
        $nidmodelo          =   $request->nidmodelo;
        $cContacto          =   $request->ccontacto;
        $cNumeroDocumento   =   $request->cnrodocumento;

        $nidmarca           = ($nidmarca == NULL) ? ($nidmarca = 0) : $nidmarca;
        $nidmodelo          = ($nidmodelo == NULL) ? ($nidmodelo = 0) : $nidmodelo;
        $dfechainicio       = ($dfechainicio == NULL) ? ($dfechainicio = '') : $dfechainicio;
        $dfechafin          = ($dfechafin == NULL) ? ($dfechafin = '') : $dfechafin;
        $cnumeropedido      = ($cnumeropedido == NULL) ? ($cnumeropedido = '') : $cnumeropedido;
        $cnumerovin         = ($cnumerovin == NULL) ? ($cnumerovin = '') : $cnumerovin;
        $cContacto          = ($cContacto == NULL) ? ($cContacto = '') : $cContacto;
        $cNumeroDocumento   = ($cNumeroDocumento == NULL) ? ($cNumeroDocumento = '') : $cNumeroDocumento;

        $arrayPedido = DB::select('exec [usp_Pedido_GetLstPedidosPendienteAprobacion] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                                    [
                                                                                        $nidempresa,
                                                                                        $nidsucursal,
                                                                                        $dfechainicio,
                                                                                        $dfechafin,
                                                                                        $cnumeropedido,
                                                                                        $cnumerovin,
                                                                                        $nidmarca,
                                                                                        $nidmodelo,
                                                                                        $cContacto,
                                                                                        $cNumeroDocumento,
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

            $arrayPedido = DB::select('exec [usp_Pedido_SetGenerarPedidoByVendedor] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $request->nIdEmpresa,
                                        $request->nIdSucursal,
                                        $request->nIdCabeceraCotizacion,
                                        $request->nIdCompra,
                                        $request->cNumeroPedido,
                                        $request->dFechaPedido,
                                        $request->nIdFormaPago,
                                        $request->nIdBanco,
                                        $request->nIdFormaFinanciamiento,
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

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $dFechaInicio       =   $request->dfechainicio;
        $dFechaFin          =   $request->dfechafin;
        $cNumeroPedido      =   $request->cnumeropedido;
        $cNumeroVin         =   $request->cnumerovin;
        $nIdMarca           =   $request->nidmarca;
        $nIdModelo          =   $request->nidmodelo;
        $nIdEstadoPedido    =   $request->nidestadopedido;
        $cContacto          =   $request->ccontacto;
        $cNumeroDocumento   =   $request->cnrodocumento;
        $ntipopersona       =   $request->ntipopersona;

        $dFechaInicio       =   ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin          =   ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $cNumeroPedido      =   ($cNumeroPedido == NULL) ? ($cNumeroPedido = '') : $cNumeroPedido;
        $cNumeroVin         =   ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;
        $nIdMarca           =   ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo          =   ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $nIdEstadoPedido    =   ($nIdEstadoPedido == NULL) ? ($nIdEstadoPedido = 0) : $nIdEstadoPedido;
        $cContacto          =   ($cContacto == NULL) ? ($cContacto = '') : $cContacto;
        $cNumeroDocumento   =   ($cNumeroDocumento == NULL) ? ($cNumeroDocumento = '') : $cNumeroDocumento;
        $ntipopersona       =   ($ntipopersona == NULL) ? ($ntipopersona = 1) : $ntipopersona;

        $arrayPedido = DB::select('exec [usp_Pedido_GetListPedidoByTipoEstado] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                            [   $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $dFechaInicio,
                                                                                $dFechaFin,
                                                                                $cNumeroPedido,
                                                                                $cNumeroVin,
                                                                                $nIdMarca,
                                                                                $nIdModelo,
                                                                                $nIdEstadoPedido,
                                                                                $cContacto,
                                                                                $cNumeroDocumento,
                                                                                $ntipopersona,
                                                                                Auth::user()->id
                                                                            ]);

        //$arrayPedido = ParametroController::arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }

    public function GetListPedidoAprobados(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $dFechaInicio       =   $request->dfechainicio;
        $dFechaFin          =   $request->dfechafin;
        $cNumeroPedido      =   $request->cnumeropedido;
        $cNumeroVin         =   $request->cnumerovin;
        $nIdMarca           =   $request->nidmarca;
        $nIdModelo          =   $request->nidmodelo;
        $nIdEstadoPedido    =   $request->nidestadopedido;
        $cContacto          =   $request->ccontacto;
        $cNumeroDocumento   =   $request->cnrodocumento;
        $ntipopersona       =   $request->ntipopersona;

        $dFechaInicio       =   ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin          =   ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $cNumeroPedido      =   ($cNumeroPedido == NULL) ? ($cNumeroPedido = '') : $cNumeroPedido;
        $cNumeroVin         =   ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;
        $nIdMarca           =   ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo          =   ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $nIdEstadoPedido    =   ($nIdEstadoPedido == NULL) ? ($nIdEstadoPedido = 0) : $nIdEstadoPedido;
        $cContacto          =   ($cContacto == NULL) ? ($cContacto = '') : $cContacto;
        $cNumeroDocumento   =   ($cNumeroDocumento == NULL) ? ($cNumeroDocumento = '') : $cNumeroDocumento;
        $ntipopersona       =   ($ntipopersona == NULL) ? ($ntipopersona = 1) : $ntipopersona;

        $arrayPedido = DB::select('exec [usp_Pedido_GetListPedidoAprobados] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
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
                                                                            $cContacto,
                                                                            $cNumeroDocumento,
                                                                            $ntipopersona,
                                                                            Auth::user()->id
                                                                        ]);

        //$arrayPedido = ParametroController::arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }

    // ====================    CREDITO VEHICULAR ====================
    public function GetListPedidoAprobadosFinanciado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $dFechaInicio       =   $request->dfechainicio;
        $dFechaFin          =   $request->dfechafin;
        $cNumeroPedido      =   $request->cnumeropedido;
        $cNumeroVin         =   $request->cnumerovin;
        $nIdMarca           =   $request->nidmarca;
        $nIdModelo          =   $request->nidmodelo;
        $nIdEstadoPedido    =   $request->nidestadopedido;
        $cContacto          =   $request->ccontacto;
        $cNumeroDocumento   =   $request->cnrodocumento;
        $ntipopersona       =   $request->ntipopersona;

        $dFechaInicio       =   ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin          =   ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $cNumeroPedido      =   ($cNumeroPedido == NULL) ? ($cNumeroPedido = '') : $cNumeroPedido;
        $cNumeroVin         =   ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;
        $nIdMarca           =   ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo          =   ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $nIdEstadoPedido    =   ($nIdEstadoPedido == NULL) ? ($nIdEstadoPedido = 0) : $nIdEstadoPedido;
        $cContacto          =   ($cContacto == NULL) ? ($cContacto = '') : $cContacto;
        $cNumeroDocumento   =   ($cNumeroDocumento == NULL) ? ($cNumeroDocumento = '') : $cNumeroDocumento;
        $ntipopersona       =   ($ntipopersona == NULL) ? ($ntipopersona = 1) : $ntipopersona;

        $arrayPedidoCV = DB::select('exec [usp_Pedido_GetListPedidoAprobadosFinanciado] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
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
                                                                            $cContacto,
                                                                            $cNumeroDocumento,
                                                                            $ntipopersona,
                                                                            Auth::user()->id
                                                                        ]);

        $arrayPedidoCV = ParametroController::arrayPaginator($arrayPedidoCV, $request);
        return ['arrayPedidoCV'=>$arrayPedidoCV];
    }

    public function SetCambiarEstadoPedidoFinanciado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $nIdCabeceraPedido  =   $request->nidcabecerapedido;
        $cEstadoFinanciado  =   $request->cestadofinanciado;
        $cglosa             =   $request->cglosa;

        $cglosa             =   ($cglosa == NULL) ? ($cglosa = '') : $cglosa;

        $objPedido = DB::select('exec [usp_Pedido_SetCambiarEstadoPedidoFinanciado] ?, ?, ?, ?, ?, ?',
                                                    [   $nIdEmpresa,
                                                        $nIdSucursal,
                                                        $nIdCabeceraPedido,
                                                        $cEstadoFinanciado,
                                                        $cglosa,
                                                        Auth::user()->id
                                                    ]);
        return response()->json($objPedido);
    }

    public function GetDocumentoByFormaPago(Request $request)
    {
        $nIdFormaPago   =   $request->nidformapago;
        $variable       =   $request->opcion;
        $variable       =   ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayDocumento =   DB::select('exec [usp_Pedido_GetDocumentoByFormaPago] ?',
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

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $nIdCabeceraPedido  =   $request->nidcabecerapedido;
        $variable           =   $request->opcion;
        $variable           =   ($variable == NULL) ? ($variable = 0) : $variable;

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

    public function GetEstadoPedidoFinanciado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $nIdCabeceraPedido  =   $request->nidcabecerapedido;
        $variable           =   $request->opcion;
        $variable           =   ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayPedidoFinanciado = DB::select('exec [usp_Pedido_GetPedidoFinanciado] ?, ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $nIdCabeceraPedido,
                                        Auth::user()->id
                                    ]);
        if($variable == "0"){
            $arrayPedidoFinanciado = ParametroController::arrayPaginator($arrayPedidoFinanciado, $request);
        }
        return ['arrayPedidoFinanciado'=>$arrayPedidoFinanciado];
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

        if ($nIdEmpresa == 1300011) {
            $img_empresa    =   public_path('img/automotoresinka.png');//CAPTURO LA RUTA DEL LOGO
            $img_marca      =   public_path('img/hyundai.png');//CAPTURO LA RUTA DE HYUNDAI
        } else {
            $img_empresa    =   public_path('img/inkalider.jpg');//CAPTURO LA RUTA DEL LOGO
            $img_marca      =   public_path('img/nissan.jpg');//CAPTURO LA RUTA DE HYUNDAI
        }

        $arrayDetallePedido = DB::select('exec [usp_Pedido_GetPdfDetallePedido] ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $nIdCabeceraPedido
                                    ]);

        $arrayPedidoDoumento = DB::select('exec [usp_Pedido_GetDocumentosByIdPDF] ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $nIdCabeceraPedido
                                    ]);

        // OBTENER LOS BANCOS POR EMPRESA
        $arrayDatosBanco = DB::select('exec [usp_Banco_GetDatosBanco] ?',
                                    [
                                        $nIdEmpresa
                                    ]);

        // OBTENER LAS URL DE LOS ARCHIVOS ASOCIADOS AL MODELO/AÑO
        $arrayDetalleDocs = DB::select('exec [usp_Pedido_GetDocs]  ?',
                                    [
                                        $nIdCabeceraPedido
                                    ]);

        // if ($arrayDetalleDocs[0]->cFichaImageUrl != null) {
        //     if ($arrayDetalleDocs[0]->cFichaTecnicaSubstring == 1) {
        //         //OBTENGO LA RUTA DINAMICA DE LA FICHA TECNICA
        //         $cadena     =   substr($arrayDetalleDocs[0]->cFichaImageUrl, 44); // Para Obtener Archivo Http
        //         //OBTENGO EL CONTENIDO DE LA FICHA TECNICA => storage/app/public/ . RUTADINAMICA
        //         $contents   =   Storage::get('public/'. $cadena);
        //     } else {
        //         //OBTENGO LA RUTA DINAMICA DE LA FICHA TECNICA
        //         $cadena     =   substr($arrayDetalleDocs[0]->cFichaImageUrl, 47); // Para Obtener Archivo Local
        //         //OBTENGO EL CONTENIDO DE LA FICHA TECNICA => storage/app/public/ . RUTADINAMICA
        //         $contents   =   Storage::get('public/'. $cadena);
        //     }
        // }

        $pdf = \PDF::loadView('pdf.pedido.pedido', [
                                                    'img_empresa'           =>  $img_empresa,
                                                    'img_marca'             =>  $img_marca,
                                                    'arrayDetallePedido'    =>  $arrayDetallePedido,
                                                    'arrayDetalleDocs'      =>  $arrayDetalleDocs,
                                                    'arrayPedidoDoumento'   =>  $arrayPedidoDoumento,
                                                    'arrayDatosBanco'       =>  $arrayDatosBanco,
                                                ]);

        return $pdf->download('Pedido -'.$nIdCabeceraPedido.'.pdf');
    }

    public function GetGenerarCartaResponsabilidad(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nIdEmpresa;
        $nIdSucursal        =   $request->nIdSucursal;
        $nIdCabeceraPedido  =   $request->nIdCabeceraPedido;

        $arrayDetallePedido = DB::select('exec [usp_Pedido_GetPdfDetallePedido] ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $nIdCabeceraPedido
                                    ]);

        $pdf = \PDF::loadView('pdf.pedido.cartaresponsabilidad', [
                                                        'arrayDetallePedido'    =>  $arrayDetallePedido
                                                    ]);

        return $pdf->download('Carta de Responsabilidad -'.$nIdCabeceraPedido.'.pdf');
    }

    public function GetGenerarRequerimiento(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa             =   $request->nIdEmpresa;
        $nIdSucursal            =   $request->nIdSucursal;
        $nIdCabeceraCotizacion  =   $request->nIdCabeceraCotizacion;
        $cNumeroVin             =   $request->cNumeroVin;

        $logo       = public_path('img/automotoresinka.png');//CAPTURO LA RUTA DEL LOGO
        $hyundai    = public_path('img/hyundai.png');//CAPTURO LA RUTA DE HYUNDAI

        $arrayDetallePedido = DB::select('exec [usp_Cotizacion_GetDetalleCotizacion] ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $nIdCabeceraCotizacion
                                    ]);

        $arrayDetalleVIN = DB::select('exec [usp_Cotizacion_GetRequerimientoVehicular] ?, ?, ?',
                                    [
                                        $nIdEmpresa,
                                        $nIdSucursal,
                                        $cNumeroVin
                                    ]);

        $pdf = \PDF::loadView('pdf.pedido.pedidorequerimiento', [
                                                        'arrayDetallePedido'    => $arrayDetallePedido,
                                                        'arrayDetalleVIN'       => $arrayDetalleVIN,
                                                        'logo'                  => $logo,
                                                        'hyundai'               => $hyundai
                                                    ]);

        return $pdf->download('Pedido Vehicular -'.$nIdCabeceraCotizacion.' - '.$cNumeroVin.'.pdf');
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

            $nIdCabeceraPedido          =   $request->nIdCabeceraPedido;
            $dMontoNuevoDolares         =   $request->dMontoNuevoDolares;
            $dMontoNuevoSoles           =   $request->dMontoNuevoSoles;
            $dMontoDescontarDolares     =   $request->dMontoDescontarDolares;
            $dMontoDescontarSoles       =   $request->dMontoDescontarSoles;
            $dPorcentaje                =   $request->dPorcentaje;
            $dTipoCambioComercial       =   $request->dTipoCambioComercial;

            $data = DB::select('exec [usp_Pedido_SetHistorialPedidoDscto] ?, ?, ?, ?, ?, ?, ?, ?',
                                                        [   $nIdCabeceraPedido,
                                                            $dMontoNuevoDolares,
                                                            $dMontoNuevoSoles,
                                                            $dMontoDescontarDolares,
                                                            $dMontoDescontarSoles,
                                                            $dPorcentaje,
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

    public function GetCampaniaObsequioByIdPedido(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $nIdCabeceraPedido  =   $request->nidcabecerapedido;
        $variable           =   $request->opcion;

        $variable = ($variable == NULL) ? ($variable = 0) : $variable;

        $arrayEVPedido = DB::select('exec [usp_Pedido_GetCampaniaObsquioByIdPedido] ?, ?, ?',
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

            // ======================================================================
            // GUARDAR ORDEN VENTA PARA EL VEHÍCULO EN SQL SERVER
            // ======================================================================
            $arraySapUpdSgcVehiculoLength = sizeof($request->arraySapUpdSgcVehiculo);
            if($arraySapUpdSgcVehiculoLength > 0) {
                $arraySapUpdSgcVehiculo = $request->arraySapUpdSgcVehiculo;
                foreach($arraySapUpdSgcVehiculo as $ep=>$det)
                {
                    $objCompra = DB::select('exec [usp_Integra_SetIntegraDetallePedido] ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $det['nIdCabeceraPedido'],
                                                                    $det['cItemCode'],
                                                                    $det['nDocEntry'],
                                                                    $det['nDocNum'],
                                                                    $det['cDocType'],
                                                                    $det['cLogRespuesta'],
                                                                    1,
                                                                    Auth::user()->id
                                                                ]);
                }
            }

            // ======================================================================
            // GUARDAR ORDEN VENTA PARA LOS ELEMENTOS DE VENTA EN SQL SERVER
            // ======================================================================
            $arraySapUpdSgcEVLength = sizeof($request->arraySapUpdSgcEV);
            if($arraySapUpdSgcEVLength > 0) {
                $arraySapUpdSgcEV = $request->arraySapUpdSgcEV;
                foreach($arraySapUpdSgcEV as $ep=>$det)
                {
                    $objCompra = DB::select('exec [usp_Integra_SetIntegraDetallePedido] ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $det['nIdCabeceraPedido'],
                                                                    $det['cItemCode'],
                                                                    $det['nDocEntry'],
                                                                    $det['nDocNum'],
                                                                    $det['cDocType'],
                                                                    $det['cLogRespuesta'],
                                                                    2,
                                                                    Auth::user()->id
                                                                ]);
                }
            }
            DB::commit();
            return response()->json($objCompra);
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetOrdenVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $nCriterio          =   $request->ncriterio;
        $cDescripcionCiterio=   $request->cvinplacanombre;

        $data = DB::select('exec [usp_Pedido_GetOrdenVenta] ?, ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nCriterio,
                                                                $cDescripcionCiterio
                                                            ]);
        return response()->json($data);
    }

    public function GetLlamadasServiciosByPedido(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         =   $request->nidempresa;
        $nIdSucursal        =   $request->nidsucursal;
        $nIdCabeceraPedido  =   $request->nidcabecerapedido;

        $arrayLlamadaServicios = DB::select('exec [usp_Pedido_GetLlamadasServiciosByPedido] ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdCabeceraPedido
                                                            ]);
        return ['arrayLlamadaServicios'=>$arrayLlamadaServicios];
    }

    public function GetLstPedidoConDescuento(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidempresa         =   $request->nidempresa;
        $nidsucursal        =   $request->nidsucursal;
        $nidmarca           =   $request->nidmarca;
        $nidmodelo          =   $request->nidmodelo;
        $dfechainicio       =   $request->dfechainicio;
        $dfechafin          =   $request->dfechafin;
        $cContacto          =   $request->ccontacto;
        $cNumeroDocumento   =   $request->cnrodocumento;
        $ntipopersona       =   $request->ntipopersona;

        $nidmarca           =   ($nidmarca == NULL) ? ($nidmarca = 0) : $nidmarca;
        $nidmodelo          =   ($nidmodelo == NULL) ? ($nidmodelo = 0) : $nidmodelo;
        $dfechainicio       =   ($dfechainicio == NULL) ? ($dfechainicio = '') : $dfechainicio;
        $dfechafin          =   ($dfechafin == NULL) ? ($dfechafin = '') : $dfechafin;
        $cContacto          =   ($cContacto == NULL) ? ($cContacto = '') : $cContacto;
        $cNumeroDocumento   =   ($cNumeroDocumento == NULL) ? ($cNumeroDocumento = '') : $cNumeroDocumento;
        $ntipopersona       =   ($ntipopersona == NULL) ? ($ntipopersona = 1) : $ntipopersona;

        $arrayCotizacionesConDescuento = DB::select('exec [usp_Pedido_GetLstPedidoConDescuento] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nidempresa,
                                        $nidsucursal,
                                        $nidmarca,
                                        $nidmodelo,
                                        $dfechainicio,
                                        $dfechafin,
                                        $cContacto,
                                        $cNumeroDocumento,
                                        $ntipopersona,
                                        Auth::user()->id
                                    ]);

        $arrayCotizacionesConDescuento = ParametroController::arrayPaginator($arrayCotizacionesConDescuento, $request);
        return ['arrayCotizacionesConDescuento'=>$arrayCotizacionesConDescuento];
    }

    public function GetListDistribucionPedido(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa             = $request->nidempresa;
        $nIdSucursal            = $request->nidsucursal;
        $nIdCabeceraPedido      = $request->nidcabecerapedido;
        $nIdCabeceraCotizacion  = $request->nidcabeceracotizacion;

        $arrayListDistribucion = DB::select('exec [usp_Pedido_GetLstDistribucionPedido] ?, ?, ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdCabeceraPedido,
                                                                $nIdCabeceraCotizacion,
                                                                Auth::user()->id
                                                            ]);
        return ['arrayListDistribucion'=>$arrayListDistribucion];
    }
}

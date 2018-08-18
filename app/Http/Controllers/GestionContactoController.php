<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class GestionContactoController extends Controller
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

    //Acciones nuevo contacto
    public function SetContactoPerNatural(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayContacto = DB::select('exec usp_Contacto_SetPerNaturalContacto ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                array(  $request->nIdTipoDocumento,
                                                        $request->cNumeroDocumento,
                                                        $request->cNombre,
                                                        $request->cApellidoPaterno,
                                                        $request->cApellidoMaterno,
                                                        $request->cUbigeo,
                                                        $request->cDireccion,
                                                        $request->cEmail,
                                                        $request->cEmailAlternativo,
                                                        $request->dFechaNacimiento,
                                                        $request->nIdEstadoCivil,
                                                        $request->cTelefonoFijo,
                                                        $request->nTelefonoMovil,
                                                        $request->nTelefonoMovilAlternativo,
                                                        $request->cCentroLaboral,
                                                        $request->nIdProfesion,
                                                        Auth::user()->id
                                                        ));

        return response()->json($arrayContacto);
    }

    public function SetContactoPerJuridica(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayContacto = DB::select('exec usp_Contacto_SetPerJuridicaContacto ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    array(  $request->cRuc,
                                            $request->cRazonSocial,
                                            $request->cUbigeo,
                                            $request->cDireccion,
                                            $request->cEmail,
                                            $request->cEmailAlternativo,
                                            $request->cTelefonoFijo,
                                            $request->nTelefonoMovil,
                                            $request->nTelefonoMovilAlternativo,
                                            //Datos Contacto
                                            $request->nIdTipoDocumentoContacto,
                                            $request->cNumeroDocumentoContacto,
                                            $request->cNombreContacto,
                                            $request->cApellidoPaternoContacto,
                                            $request->cApellidoMaternoContacto,
                                            $request->cEmailPrincipalContacto,
                                            $request->cTelefonoMovilContacto,
                                            Auth::user()->id
                                        ));

        return response()->json($arrayContacto);
    }

    public function SetContactoRefVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            //Itera todas las referencias de vehiculos
            foreach($detalles as $ep=>$det)
            {
                DB::select('exec usp_Contacto_SetReferenciaVehiculo ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                        array(
                                                            $request->nIdEmpresa,
                                                            $request->nIdSucursal,
                                                            $request->nIdCronograma,
                                                            $request->nIdContacto,
                                                            $det['nIdProveedorRef'],
                                                            $det['nIdLineaRef'],
                                                            $det['nIdMarcaRef'],
                                                            $det['nIdModeloRef'],
                                                            $det['nAnioFabricacionRef'],
                                                            $det['nAnioModeloRef'],
                                                            Auth::user()->id
                                                        ));
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetContactoSegRefVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayContacto = DB::select('exec usp_Contacto_SetReferenciaVehiculo ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                    array(
                                                        $request->nIdEmpresa,
                                                        $request->nIdSucursal,
                                                        $request->nIdCronograma,
                                                        $request->nIdContacto,
                                                        $request->nIdProveedor,
                                                        $request->nIdLinea,
                                                        $request->nIdMarca,
                                                        $request->nIdModelo,
                                                        $request->nAnioFabricacion,
                                                        $request->nAnioModelo,
                                                        Auth::user()->id
                                                    ));
        return response()->json($arrayContacto);
    }

    public function GetContactoByVendedor(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCronograma = $request->nidcronograma;
        $nTipoPersona = $request->ntipopersona;
        $cNroDocumento = $request->cnrodocumento;
        $cFiltroDescripcion = $request->cfiltrodescripcion;

        if($cNroDocumento == ''){
            $cNroDocumento = "";
        }
        if($cFiltroDescripcion == ''){
            $cFiltroDescripcion = "";
        }

        $arrayContacto = DB::select('exec usp_Contacto_GetListContactoByVendedor ?, ?, ?, ?, ?, ?, ?',
                                                                        array(  $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $nIdCronograma,
                                                                                $nTipoPersona,
                                                                                $cNroDocumento,
                                                                                $cFiltroDescripcion,
                                                                                Auth::user()->id
                                                                                ));

        $arrayContacto = $this->arrayPaginator($arrayContacto, $request);
        return ['arrayContacto'=>$arrayContacto];
    }

    public function SetContactoCarteraMes(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayContacto = DB::select('exec usp_Contacto_SetContactoCarteraMes ?, ?, ?',
                                                            array(  $request->nIdCronograma,
                                                                    $request->nIdReferenciaVehiculoContacto,
                                                                    Auth::user()->id
                                                                    ));

        return response()->json($arrayContacto);
    }

    public function GetCarteraMesByVendedor(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCronograma = $request->nidcronograma;
        $nTipoPersona = $request->ntipopersona;
        $cNroDocumento = $request->cnrodocumento;
        $cFiltroDescripcion = $request->cfiltrodescripcion;

        if($cNroDocumento == ''){
            $cNroDocumento = "";
        }
        if($cFiltroDescripcion == ''){
            $cFiltroDescripcion = "";
        }

        $arrayContactoCarteraMes = DB::select('exec usp_Contacto_GetContactoCarteraMes ?, ?, ?, ?, ?, ?, ?',
                                                                        array(  $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $nIdCronograma,
                                                                                $nTipoPersona,
                                                                                $cNroDocumento,
                                                                                $cFiltroDescripcion,
                                                                                Auth::user()->id
                                                                                ));

        $arrayContactoCarteraMes = $this->arrayPaginator($arrayContactoCarteraMes, $request);
        return ['arrayContactoCarteraMes'=>$arrayContactoCarteraMes];
    }

    public function GetContactoNaturalById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdContacto = $request->nidcontacto;
        $nIdPersonaNatural = $request->nidpersonanatural;

        $contacto = DB::select('exec usp_Contacto_GetContactoNaturalById ?, ?',
                                                                        array(  $nIdContacto,
                                                                                $nIdPersonaNatural
                                                                                ));

        return response()->json($contacto);
    }

    public function GetRefVehiculoByContacto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdContacto = $request->nidcontacto;

        $arraySegReferenciavehiculo = DB::select('exec usp_Contacto_GetRefVehiculoByContacto ?, ?, ?',
                                                                        array(  $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $nIdContacto
                                                                                ));

        $arraySegReferenciavehiculo = $this->arrayPaginator($arraySegReferenciavehiculo, $request);
        return ['arraySegReferenciavehiculo'=>$arraySegReferenciavehiculo];
    }

    //Acciones Mis Contactos
    public function GetContactos(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $tipopersona    =   $request->ntipoPersona;
        $ndocumento     =   $request->cdocumento;
        $ccontacto      =   $request->ccontacto;
        $idusuario      =   Auth::user()->id;

        $ndocumento = ($ndocumento == NULL) ? ($ndocumento = ' ') : $ndocumento;
        $ccontacto = ($ccontacto == NULL) ? ($ccontacto = ' ') : $ccontacto;

        $arrayContactos = DB::select('exec usp_Contacto_GetContactos ?, ?, ?, ?',
                                                            array(  $tipopersona,
                                                                    $ndocumento,
                                                                    $ccontacto,
                                                                    $idusuario
                                                            ));

        $arrayContactos = $this->arrayPaginator($arrayContactos, $request);
        return ['arrayContactos'=>$arrayContactos];
    }

    //Acciones Contactos por vendedor
    public function GetVendedores(Request $request)
    {
        $variable = $request->opcion;

        $contactosbyvendedor = DB::select('exec usp_Contacto_GetVendedores_activos');

        $data = [];
        if($variable == "0"){
            $data[0] = [
                'nIdVendedor'   => 0,
                'cUsuario'      => 'SELECCIONE',
            ];
        }
        foreach ($contactosbyvendedor as $key => $value) {
           $data[$key+1] =[
                'nIdVendedor'   => $value->nIdVendedor,
                'cUsuario'      => $value->cUsuario,
            ];
        }

        return response()->json($data);
    }

    public function GetContactosPorVendedor(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $tipopersona    =   $request->ntipoPersona;
        $ndocumento     =   $request->cdocumento;
        $ccontacto      =   $request->ccontacto;
        $nvenvedor      =   $request->vendedor;

        $ndocumento = ($ndocumento == NULL) ? ($ndocumento = ' ') : $ndocumento;
        $ccontacto = ($ccontacto == NULL) ? ($ccontacto = ' ') : $ccontacto;
        $nvenvedor = ($nvenvedor == 0) ? ($nvenvedor = ' ') : $nvenvedor;

        $arrayContactosPorVendedor = DB::select('exec usp_Contacto_GetContactosPorVendedor ?, ?, ?, ?',
                                                            array(  $tipopersona,
                                                                    $ndocumento,
                                                                    $ccontacto,
                                                                    $nvenvedor
                                                                ));

        $arrayContactosPorVendedor = $this->arrayPaginator($arrayContactosPorVendedor, $request);
        return ['arrayContactosPorVendedor'=>$arrayContactosPorVendedor];
    }

    public function UpdReasignarContacto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $idasignacion   =   $request->asigcontactvendedor;
        $idvendedor     =   $request->vendedor;
        $idusuario      =   Auth::user()->id;

        $data = DB::select('exec usp_Contacto_UpdReasignarContacto ?, ?, ?',
                                                            array(  $idasignacion,
                                                                    $idvendedor,
                                                                    $idusuario
                                                                ));

        return ['data' => $data];
    }

    public function GetRefVehiculoByContacto_JFV(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdContacto = $request->nidcontacto;

        $arraySegReferenciavehiculo = DB::select('exec usp_Contacto_GetRefVehiculoByContacto_JFV ?, ?, ?',
                                                                        array(  $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $nIdContacto
                                                                                ));

        $arraySegReferenciavehiculo = $this->arrayPaginator($arraySegReferenciavehiculo, $request);
        return ['arraySegReferenciavehiculo'=>$arraySegReferenciavehiculo];
    }

    //Acciones contactos libres
    public function GetContactosLibres(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $tipopersona    =   $request->ntipoPersona;
        $ndocumento     =   $request->cdocumento;
        $ccontacto      =   $request->ccontacto;
        $ctipocontacto  =   $request->ctipocontacto;

        $ndocumento = ($ndocumento == NULL) ? ($ndocumento = ' ') : $ndocumento;
        $ccontacto = ($ccontacto == NULL) ? ($ccontacto = ' ') : $ccontacto;
        $ctipocontacto = ($ctipocontacto == 0) ? ($ctipocontacto = 0) : $ctipocontacto;

        $arrayContactosLibres = DB::select('exec usp_Contacto_GetContactosLibres ?, ?, ?, ?',
                                                            array(  $tipopersona,
                                                                    $ndocumento,
                                                                    $ccontacto,
                                                                    $ctipocontacto
                                                                ));

        $arrayContactosLibres = $this->arrayPaginator($arrayContactosLibres, $request);
        return ['arrayContactosLibres'=>$arrayContactosLibres];
    }
}

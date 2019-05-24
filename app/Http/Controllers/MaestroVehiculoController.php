<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MaestroVehiculoController extends Controller
{
    public function SetRegistrarVehiculoPlaca(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidcompra              =   $request->fillNuevoVehiculo['nidcompra'];
        $nidvehiculo            =   $request->fillNuevoVehiculo['nidvehiculo'];
        // $cnroplaca              =   $request->fillNuevoVehiculo['cnroplaca'];
        // $cnrotarjetapropiedad   =   $request->fillNuevoVehiculo['cnrotarjetapropiedad'];
        $nidclase               =   $request->fillNuevoVehiculo['nidclase'];
        $nidmarca               =   $request->fillNuevoVehiculo['nidmarca'];
        $nidmodelo              =   $request->fillNuevoVehiculo['nidmodelo'];
        $cnombrecolor           =   $request->fillNuevoVehiculo['cnombrecolor'];
        $nidaniomodelo          =   $request->fillNuevoVehiculo['nidaniomodelo'];
        $nidtranccion           =   $request->fillNuevoVehiculo['nidtranccion'];
        $nidcategoria           =   $request->fillNuevoVehiculo['nidcategoria'];
        $nidcilindrada          =   $request->fillNuevoVehiculo['nidcilindrada'];
        $nidtransmision         =   $request->fillNuevoVehiculo['nidtransmision'];
        $nidcombustible         =   $request->fillNuevoVehiculo['nidcombustible'];
        $dfechaventa            =   $request->fillNuevoVehiculo['dfechaventa'];
        $cnromotor              =   $request->fillNuevoVehiculo['cnromotor'];
        $cnroserie              =   $request->fillNuevoVehiculo['cnroserie'];
        $cnrocilindros          =   $request->fillNuevoVehiculo['cnrocilindros'];
        $cnrorueda              =   $request->fillNuevoVehiculo['cnrorueda'];
        $cnroeje                =   $request->fillNuevoVehiculo['cnroeje'];
        $cpotencia              =   $request->fillNuevoVehiculo['cpotencia'];
        $cnropasajeros          =   $request->fillNuevoVehiculo['cnropasajeros'];
        $cnroasiento            =   $request->fillNuevoVehiculo['cnroasiento'];
        $cpesoseco              =   $request->fillNuevoVehiculo['fpesoseco'];
        $cpesobruto             =   $request->fillNuevoVehiculo['fpesobruto'];
        $clongitud              =   $request->fillNuevoVehiculo['flongitud'];
        $caltura                =   $request->fillNuevoVehiculo['faltura'];
        $cancho                 =   $request->fillNuevoVehiculo['fancho'];
        $ccargautil             =   $request->fillNuevoVehiculo['fcargautil'];
        $cnacionesunidas        =   $request->fillNuevoVehiculo['cnacionesunidas'];

        $nidcompra              =   ($nidcompra == NULL)   ? ($nidcompra = 0) : $nidcompra;
        $nidvehiculo            =   ($nidvehiculo == NULL)   ? ($nidvehiculo = ' ') : $nidvehiculo;
        // $cnroplaca              =   ($cnroplaca == NULL)              ? ($cnroplaca = ' ') : $cnroplaca;
        // $cnrotarjetapropiedad   =   ($cnrotarjetapropiedad == NULL)   ? ($cnrotarjetapropiedad = ' ') : $cnrotarjetapropiedad;
        $nidclase               =   ($nidclase == NULL)       ? ($nidclase = ' ')         : $nidclase;
        $nidmarca               =   ($nidmarca == NULL)       ? ($nidmarca = ' ')         : $nidmarca;
        $nidmodelo              =   ($nidmodelo == NULL)      ? ($nidmodelo = ' ')        : $nidmodelo;
        $cnombrecolor           =   ($cnombrecolor == NULL)       ? ($cnombrecolor = ' ')         : $cnombrecolor;
        $nidaniomodelo          =   ($nidaniomodelo == NULL)       ? ($nidaniomodelo = ' ')         : $nidaniomodelo;
        $nidtranccion           =   ($nidtranccion == NULL) ? ($nidtranccion = ' ')   : $nidtranccion;
        $nidcategoria           =   ($nidcategoria == NULL) ? ($nidcategoria = ' ')   : $nidcategoria;
        $nidcilindrada          =   ($nidcilindrada == NULL) ? ($nidcilindrada = ' ')   : $nidcilindrada;
        $nidtransmision         =   ($nidtransmision == NULL) ? ($nidtransmision = ' ')   : $nidtransmision;
        $nidcombustible         =   ($nidcombustible == NULL) ? ($nidcombustible = ' ')   : $nidcombustible;
        $dfechaventa            =   ($dfechaventa == NULL)    ? ($dfechaventa = ' ')      : $dfechaventa;
        $cnromotor              =   ($cnromotor == NULL)      ? ($cnromotor = ' ')        : $cnromotor;
        $cnroserie              =   ($cnroserie == NULL)      ? ($cnroserie = ' ')        : $cnroserie;
        $cnrocilindros          =   ($cnrocilindros == NULL)  ? ($cnrocilindros = ' ')    : $cnrocilindros;
        $cnrorueda              =   ($cnrorueda == NULL)      ? ($cnrorueda = ' ')        : $cnrorueda;
        $cnroeje                =   ($cnroeje == NULL)      ? ($cnroeje = ' ')        : $cnroeje;
        $cpotencia              =   ($cpotencia == NULL)      ? ($cpotencia = ' ')        : $cpotencia;
        $cnropasajeros          =   ($cnropasajeros == NULL)  ? ($cnropasajeros = ' ')    : $cnropasajeros;
        $cnroasiento            =   ($cnroasiento == NULL)    ? ($cnroasiento = ' ')      : $cnroasiento;
        $cpesoseco              =   ($cpesoseco == NULL)      ? ($cpesoseco = ' ')        : $cpesoseco;
        $cpesobruto             =   ($cpesobruto == NULL)     ? ($cpesobruto = ' ')       : $cpesobruto;
        $clongitud              =   ($clongitud == NULL)      ? ($clongitud = ' ')        : $clongitud;
        $caltura                =   ($caltura == NULL)        ? ($caltura = ' ')          : $caltura;
        $cancho                 =   ($cancho == NULL)         ? ($cancho = ' ')           : $cancho;
        $ccargautil             =   ($ccargautil == NULL)     ? ($ccargautil = ' ')       : $ccargautil;
        $cnacionesunidas        =   ($cnacionesunidas == NULL)     ? ($cnacionesunidas = ' ')       : $cnacionesunidas;

        $nFlagEditar = $request->nFlagEditar;

        $arrayVehiculoPlaca = DB::select('exec [usp_MaestroVehiculo_SetVehiculoPlaca]
                                                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nidcompra,
                                        0,
                                        $nidvehiculo,
                                        $nidclase,
                                        $nidmarca,
                                        $nidmodelo,
                                        $cnombrecolor,
                                        $nidaniomodelo,
                                        $nidtranccion,
                                        $nidcategoria,
                                        $nidcilindrada,
                                        $nidtransmision,
                                        $nidcombustible,
                                        $dfechaventa,
                                        $cnromotor,
                                        $cnroserie,
                                        $cnrocilindros,
                                        $cnrorueda,
                                        $cnroeje,
                                        $cpotencia,
                                        $cnropasajeros,
                                        $cnroasiento,
                                        $cpesoseco,
                                        $cpesobruto,
                                        $clongitud,
                                        $caltura,
                                        $cancho,
                                        $ccargautil,
                                        $cnacionesunidas,
                                        $nFlagEditar,
                                        Auth::user()->id
                                    ]);

        return response()->json($arrayVehiculoPlaca);
    }

    public function SetRegistrarPerNatural(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidpersona             =   $request->fillPropietario['nidpersona'];
        $ntpodocumento          =   $request->fillPropietario['ntpodocumento'];
        $cnrodocumento          =   $request->fillPropietario['cnrodocumento'];
        $cnombre                =   $request->fillPropietario['cnombre'];
        $capepaterno            =   $request->fillPropietario['capepaterno'];
        $capematerno            =   $request->fillPropietario['capematerno'];
        $ccode                  =   $request->fillPropietario['ccode'];
        $cdireccion             =   $request->fillPropietario['cdireccion'];
        $cmailprincipal         =   $request->fillPropietario['cmailprincipal'];
        $cmailalternativo       =   $request->fillPropietario['cmailalternativo'];
        $dfecnacimiento         =   $request->fillPropietario['dfecnacimiento'];
        $nestadocivil           =   $request->fillPropietario['nestadocivil'];
        $ctelefonofijo          =   $request->fillPropietario['ctelefonofijo'];
        $ncelular               =   $request->fillPropietario['ncelular'];
        $ncelularalternativo    =   $request->fillPropietario['ncelularalternativo'];
        $ccentrolaboral         =   $request->fillPropietario['ccentrolaboral'];
        $nprofesion             =   $request->fillPropietario['nprofesion'];
        $cnrolicencia           =   $request->fillPropietario['cnrolicencia'];

        $nidpersona             = ($nidpersona == NULL) ? ($nidpersona = ' ') : $nidpersona;
        $ntpodocumento          = ($ntpodocumento == NULL) ? ($ntpodocumento = ' ') : $ntpodocumento;
        $cnrodocumento          = ($cnrodocumento == NULL) ? ($cnrodocumento = ' ') : $cnrodocumento;
        $cnombre                = ($cnombre == NULL) ? ($cnombre = ' ') : $cnombre;
        $capepaterno            = ($capepaterno == NULL) ? ($capepaterno = ' ') : $capepaterno;
        $capematerno            = ($capematerno == NULL) ? ($capematerno = ' ') : $capematerno;
        $ccode                  = ($ccode == NULL) ? ($ccode = ' ') : $ccode;
        $cdireccion             = ($cdireccion == NULL) ? ($cdireccion = ' ') : $cdireccion;
        $cmailprincipal         = ($cmailprincipal == NULL) ? ($cmailprincipal = ' ') : $cmailprincipal;
        $cmailalternativo       = ($cmailalternativo == NULL) ? ($cmailalternativo = ' ') : $cmailalternativo;
        $dfecnacimiento         = ($dfecnacimiento == NULL) ? ($dfecnacimiento = ' ') : $dfecnacimiento;
        $nestadocivil           = ($nestadocivil == NULL) ? ($nestadocivil = ' ') : $nestadocivil;
        $ctelefonofijo          = ($ctelefonofijo == NULL) ? ($ctelefonofijo = ' ') : $ctelefonofijo;
        $ncelular               = ($ncelular == NULL) ? ($ncelular = ' ') : $ncelular;
        $ncelularalternativo    = ($ncelularalternativo == NULL) ? ($ncelularalternativo = ' ') : $ncelularalternativo;
        $ccentrolaboral         = ($ccentrolaboral == NULL) ? ($ccentrolaboral = ' ') : $ccentrolaboral;
        $nprofesion             = ($nprofesion == NULL) ? ($nprofesion = ' ') : $nprofesion;
        $cnrolicencia           = ($cnrolicencia == NULL) ? ($cnrolicencia = ' ') : $cnrolicencia;


        $nIdVehiculoPlaca   = $request->nIdVehiculoPlaca;
        $nFlagEditar        = $request->nFlagEditar;

        $arrayPropietario = DB::select('exec [usp_MaestroVehiculo_SetPersonaNatural]
                                                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                [
                                                    $nidpersona,
                                                    $ntpodocumento,
                                                    trim($cnrodocumento),
                                                    $cnombre,
                                                    $capepaterno,
                                                    $capematerno,
                                                    $ccode,
                                                    $cdireccion,
                                                    $cmailprincipal,
                                                    $cmailalternativo,
                                                    $dfecnacimiento,
                                                    $nestadocivil,
                                                    $ctelefonofijo,
                                                    $ncelular,
                                                    $ncelularalternativo,
                                                    $ccentrolaboral,
                                                    $nprofesion,
                                                    $cnrolicencia,
                                                    $nIdVehiculoPlaca,
                                                    $nFlagEditar,
                                                    Auth::user()->id
                                                ]);
        return response()->json($arrayPropietario);
    }

    public function SetRegistrarPerJuridica(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidpersona             =   $request->fillPropietario['nidpersona'];
        $cnrodocumento          =   $request->fillPropietario['cnrodocumento'];
        $cnombre                =   $request->fillPropietario['cnombre'];
        $ccode                  =   $request->fillPropietario['ccode'];
        $cdireccion             =   $request->fillPropietario['cdireccion'];
        $cmailprincipal         =   $request->fillPropietario['cmailprincipal'];
        $cmailalternativo       =   $request->fillPropietario['cmailalternativo'];
        $ctelefonofijo          =   $request->fillPropietario['ctelefonofijo'];
        $ncelular               =   $request->fillPropietario['ncelular'];
        $ncelularalternativo    =   $request->fillPropietario['ncelularalternativo'];

        $nidpersona             = ($nidpersona == NULL) ? ($nidpersona = ' ') : $nidpersona;
        $cnrodocumento          = ($cnrodocumento == NULL) ? ($cnrodocumento = ' ') : $cnrodocumento;
        $cnombre                = ($cnombre == NULL) ? ($cnombre = ' ') : $cnombre;
        $ccode                  = ($ccode == NULL) ? ($ccode = ' ') : $ccode;
        $cdireccion             = ($cdireccion == NULL) ? ($cdireccion = ' ') : $cdireccion;
        $cmailprincipal         = ($cmailprincipal == NULL) ? ($cmailprincipal = ' ') : $cmailprincipal;
        $cmailalternativo       = ($cmailalternativo == NULL) ? ($cmailalternativo = ' ') : $cmailalternativo;
        $ctelefonofijo          = ($ctelefonofijo == NULL) ? ($ctelefonofijo = ' ') : $ctelefonofijo;
        $ncelular               = ($ncelular == NULL) ? ($ncelular = ' ') : $ncelular;
        $ncelularalternativo    = ($ncelularalternativo == NULL) ? ($ncelularalternativo = ' ') : $ncelularalternativo;

        $nIdVehiculoPlaca   = $request->nIdVehiculoPlaca;
        $nFlagEditar        = $request->nFlagEditar;

        $arrayPropietario = DB::select('exec [usp_MaestroVehiculo_SetPerJuridica] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nidpersona,
                                        trim($cnrodocumento),
                                        $cnombre,
                                        $ccode,
                                        $cdireccion,
                                        $cmailprincipal,
                                        $cmailalternativo,
                                        $ctelefonofijo,
                                        $ncelular,
                                        $ncelularalternativo,
                                        $nIdVehiculoPlaca,
                                        $nFlagEditar,
                                        Auth::user()->id
                                    ]);

        return response()->json($arrayPropietario);
    }

    public function SetRegistrarSoat(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arraySOAT          = $request->arraySOAT;
        $fillProveedor      = $request->fillProveedor;
        $nIdVehiculoPlaca   = $request->nIdVehiculoPlaca;
        $nFlagEditar        = $request->nFlagEditar;

        try{
            DB::beginTransaction();
            $arraySOATLength = sizeof($arraySOAT);
            if($arraySOATLength > 0){
                foreach ($arraySOAT as $key => $value) {
                    $arraySoat = DB::select('exec usp_MaestroVehiculo_SetSoat ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $value['nidsoat'],
                                        $value['csoat'],
                                        $nIdVehiculoPlaca,
                                        $fillProveedor['nidproveedor'],
                                        $value['dfechainicio'],
                                        $value['dfechafin'],
                                        $value['nidestado'],
                                        $nFlagEditar,
                                        Auth::user()->id
                                    ]);
                }
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetDetalleMaestroVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa         = $request->nidempresa;
        $nIdSucursal        = $request->nidsucursal;
        $nTipoPersona       =   $request->ntipopersona;
        $cNroDocumento      =   $request->cnrodocumento;
        $cFiltroDescripcion =   $request->cfiltrodescripcion;
        $nIdMarca           =   $request->nidmarca;
        $nIdModelo          =   $request->nidmodelo;
        $cNombreComercial   =   $request->cnombrecomercial;
        $cNumeroVin         =   $request->cnumerovin;
        $nIdVendedor        =   Auth::user()->id;

        $cNroDocumento      =   ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cFiltroDescripcion =   ($cFiltroDescripcion == NULL) ? ($cFiltroDescripcion = ' ') : $cFiltroDescripcion;
        $nIdMarca           =   ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo          =   ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;
        $cNombreComercial   =   ($cNombreComercial == NULL) ? ($cNombreComercial = '') : $cNombreComercial;
        $cNumeroVin         =   ($cNumeroVin == NULL) ? ($cNumeroVin = ' ') : $cNumeroVin;

        $arrayVehiculo = DB::select('exec [usp_MaestroVehiculo_GetDetalleMaestroVehiculo] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                        [   $nIdEmpresa,
                                                                            $nIdSucursal,
                                                                            $nTipoPersona,
                                                                            $cNroDocumento,
                                                                            $cFiltroDescripcion,
                                                                            $nIdMarca,
                                                                            $nIdModelo,
                                                                            $cNombreComercial,
                                                                            $cNumeroVin,
                                                                            $nIdVendedor
                                                                        ]);

        $arrayVehiculo = ParametroController::arrayPaginator($arrayVehiculo, $request);
        return ['arrayVehiculo'=>$arrayVehiculo];
    }

    public function SetRegistrarPropietario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayPropietario = DB::select('exec [usp_MaestroVehiculo_SetPropietarioVehiculo]  ?, ?, ?, ?, ?, ?',
                                                [   $request->cFlagTipoPersona,
                                                    $request->nIdPersonaNatural,
                                                    $request->nIdPersonaJuridica,
                                                    $request->nIdVehiculoPlaca,
                                                    $request->nFlagEditar,
                                                    Auth::user()->id
                                                ]);
        return response()->json($arrayPropietario);
    }

    public function GetDataPlantilla(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdCompra  =   $request->nIdCompra;

        $arrayVehiculo = DB::select('exec usp_VersionVeh_GetVehiculoVerPlantilla ?',
                                                                        [
                                                                            $nIdCompra
                                                                        ]);

        return response()->json($arrayVehiculo);
    }
}

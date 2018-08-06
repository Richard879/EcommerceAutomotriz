<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class GestionContactoController extends Controller
{
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
                                                                    $request->nIdUsuario
                                                                    ));
        
        return response()->json($arrayContacto);
    }

    public function SetContactoRefVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                DB::select('exec usp_Contacto_SetReferenciaVehiculo ?, ?, ?, ?, ?', 
                                                            array($request->nIdContacto,                                                              
                                                                $det['nIdProveedorRef'],
                                                                $det['nIdLineaRef'],
                                                                $det['nIdMarcaRef'],
                                                                $det['nIdModeloRef']
                                                            ));
            }    
            DB::commit(); 
        } catch (Exception $e){
            DB::rollBack();
        }     
    }
}

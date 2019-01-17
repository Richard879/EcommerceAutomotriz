<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GestionRolesController extends Controller
{
    public function GetLstRoles(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdContacto = $request->nidcontacto;
        $nIdPersonaJuridico = $request->nidpersonajuridico;

        $contacto = DB::select('exec usp_Contacto_GetContactoJuridicoById ?, ?',
                                                                        array(  $nIdContacto,
                                                                                $nIdPersonaJuridico
                                                                                ));

        return response()->json($contacto);
    }
}

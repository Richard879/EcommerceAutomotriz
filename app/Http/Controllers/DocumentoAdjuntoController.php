<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentoAdjuntoController extends Controller
{
    public function subirArchivo(Request $request)
    {
        $file = $request->file;
        $bandera = str_random(10);

        $ruta = Storage::putFileAs('uploads/Depositos', $file, $bandera .'_'. $file->getClientOriginalName());

        $arrayDocumento = DB::select('exec usp_DocumentoAdjunto_SetArchivo ?, ?, ?',
                                                        [  asset($ruta),
                                                            $file->getClientOriginalName(),
                                                            Auth::user()->id
                                                        ]);

        return response()->json($arrayDocumento);
    }

    public function subirArchivoPDI(Request $request)
    {
        $file = $request->file;
        $bandera = str_random(10);

        $ruta = Storage::putFileAs('public/PDI', $file, $bandera .'_'. $file->getClientOriginalName());

        $arrayDocumento = DB::select('exec usp_DocumentoAdjunto_SetArchivo ?, ?, ?',
                                                        [
                                                            asset($ruta),
                                                            $file->getClientOriginalName(),
                                                            Auth::user()->id
                                                        ]);

        return response()->json($arrayDocumento);
    }
}

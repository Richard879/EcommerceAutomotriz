<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ReporteController extends Controller
{
    public function GetListSubReportesByReporte(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdPar = $request->nIdPar;

        $reportes = DB::select('exec [usp_Reporte_GetListSubReportesByReporte] ?',
                                                            [   $nIdPar
                                                            ]);

        // $reportes = ParametroController::arrayPaginator($reportes, $request);
        // return ['reportes' => $reportes];
        return response()->json($reportes);
    }

    public function GetCotizacionGenerarReporte01(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     = $request->nIdEmpresa;
        $nIdSucursal    = $request->nIdSucursal;
        $dFechaPeriodo  = $request->dFechaPeriodo;
        $dFechaExacta   = $request->dFechaExacta;
        $cNombreUsuario = $request->cNombreUsuario;

        $dFechaPeriodo  = ($dFechaPeriodo == NULL) ? ($dFechaPeriodo = ' ') : $dFechaPeriodo;
        $dFechaExacta   = ($dFechaExacta == NULL) ? ($dFechaExacta = ' ') : $dFechaExacta;
        $cNombreUsuario = ($cNombreUsuario == NULL) ? ($cNombreUsuario = ' ') : $cNombreUsuario;

        $reportes = DB::select('exec [usp_RptComercial_Cotizacion_GetGenerarReporte01] ?, ?, ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $dFechaPeriodo,
                                                                $dFechaExacta,
                                                                $cNombreUsuario
                                                            ]);

        $dFecha  = ($dFechaPeriodo == NULL) ? $dFechaExacta : $dFechaPeriodo;

        $pdf = \PDF::loadView('pdf.reportes.reporte01', ['reportes' => $reportes, 'dFecha' => $dFecha]);
        return $pdf->download('Número de Cotizaciones Generadas Por Vendedor - Periodo -'.$dFecha.'.pdf');
    }

    public function GetPedidoGenerarReporte04(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     = $request->nIdEmpresa;
        $nIdSucursal    = $request->nIdSucursal;
        $cNombreUsuario = $request->cNombreUsuario;

        $cNombreUsuario = ($cNombreUsuario == NULL) ? ($cNombreUsuario = ' ') : $cNombreUsuario;

        $reportes = DB::select('exec [usp_RptComercial_Pedido_GetGenerarReporte04] ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $cNombreUsuario
                                                            ]);

        $pdf = \PDF::loadView('pdf.reportes.reporte04', ['reportes' => $reportes]);
        return $pdf->download('Tiempo medio invertido desde la prospección hasta el pedido.pdf');
    }
}

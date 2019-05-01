<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class CompraExport implements FromQuery, ShouldQueue
{
    use Exportable;

    public function __construct(Request $request)
    {
        $this->nIdEmpresa     = $request->nidempresa;
        $this->nIdSucursal    = $request->nidsucursal;
        $this->dFechaInicio   = $request->dfechainicio;
        $this->dFechaFin      = $request->dfechafin;
        $this->nOrdenCompra   = $request->nordencompra;
        $this->cNumeroVin     = $request->cnumerovin;
        $this->nIdMarca       = $request->nidmarca;
        $this->nIdModelo      = $request->nidmodelo;
    }

    public function query()
    {
        $nIdEmpresa     =   $this->nIdEmpresa;
        $nIdSucursal    =   $this->nIdSucursal;
        $nOrdenCompra   =   $this->nOrdenCompra;

        $dFechaInicio   =   ($this->dFechaInicio == NULL) ? ($this->dFechaInicio = '') : $dFechaInicio;
        $dFechaFin      =   ($this->dFechaFin == NULL) ? ($this->dFechaFin = '') : $this->dFechaFin;
        $cNumeroVin     =   ($this->cNumeroVin == NULL) ? ($this->cNumeroVin = '') : $this->cNumeroVin;
        $nIdMarca       =   ($this->nIdMarca == NULL) ? ($this->nIdMarca = 0) : $this->nIdMarca;
        $nIdModelo      =   ($this->nIdModelo == NULL) ? ($this->nIdModelo = 0) : $this->nIdModelo;

        $arrayCompra = DB::select('exec [usp_Compra_GetCompra] ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $dFechaInicio,
                                                                $dFechaFin,
                                                                $nOrdenCompra,
                                                                $cNumeroVin,
                                                                $nIdMarca,
                                                                $nIdModelo
                                                            ]);

        return $arrayCompra;
    }
}

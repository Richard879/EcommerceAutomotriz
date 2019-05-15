<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ExportDetalleVentaRetail implements
    FromArray,
    Responsable,
    WithMapping,
    WithHeadings,
    WithColumnFormatting,
    WithTitle,
    WithStrictNullComparison
{
    use Exportable;

    /**
     * @return Builder
     */
    public function array(): array
    {
        $data = DB::select('exec [usp_Reporte_GetDetalleVentaRetail]');

        return $data;
    }

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->COMPANIA,
            $row->CONCESIONARIO,
            $row->NRO_PEDIDO,
            $row->DESC_CLIENTE,
            $row->VIN,
            $row->COD_VENDEDOR,
            $row->CARACT1,
            $row->STATUS_PEDIDO,
            $row->STATUS_DEPOSITO,
            $row->TIPO_VENTA,
            $row->MARCA,
            $row->MODELO,
            $row->ANIO_MODEL,
            $row->ANIO_FABRI,
            $row->COMENTARIO,
            $row->ENTIDAD_FIN,
            $row->FECHA_CANCELACION
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'COMPANIA',
            'CONCESIONARIO',
            'NRO_PEDIDO',
            'DESC_CLIENTE',
            'VIN',
            'COD_VENDEDOR',
            'CARACT1',
            'STATUS_PEDIDO',
            'STATUS_DEPOSITO',
            'TIPO_VENTA',
            'MARCA',
            'MODELO',
            'ANIO_MODEL',
            'ANIO_FABRI',
            'COMENTARIO',
            'ENTIDAD_FIN',
            'FECHA_CANCELACION'
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_GENERAL,
            'B' => NumberFormat::FORMAT_GENERAL,
            'C' => NumberFormat::FORMAT_GENERAL,
            'D' => NumberFormat::FORMAT_GENERAL,
            'E' => NumberFormat::FORMAT_GENERAL,
            'F' => NumberFormat::FORMAT_GENERAL,
            'G' => NumberFormat::FORMAT_GENERAL,
            'H' => NumberFormat::FORMAT_GENERAL,
            'I' => NumberFormat::FORMAT_GENERAL,
            'J' => NumberFormat::FORMAT_GENERAL,
            'K' => NumberFormat::FORMAT_GENERAL,
            'L' => NumberFormat::FORMAT_GENERAL,
            'M' => NumberFormat::FORMAT_GENERAL,
            'N' => NumberFormat::FORMAT_GENERAL,
            'O' => NumberFormat::FORMAT_GENERAL,
            'P' => NumberFormat::FORMAT_GENERAL,
            'Q' => NumberFormat::FORMAT_GENERAL
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Detalle de Venta Retail';
    }
}

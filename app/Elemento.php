<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elemento extends Model
{
    protected $table = 'Elemento';
    protected $fillable =['nEmpresaId',
                        'nSucursalId',
                        'nProveedorId',
                        'nTipoElementoId', 
                        'nMonedaId',
                        'cElemenNombre',
                        'fElemenValorVenta',
                        'fElemenValorMinimoVenta',
                        'cCodigoERP',
                        'nUsuarioId'];
}

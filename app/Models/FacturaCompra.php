<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaCompra extends Model
{
    protected $table = 'facturas_compra';

    protected $fillable = [
        'proveedor_nombre',
        'proveedor_rut',
        'proveedor_giro',
        'tipo_documento',
        'folio',
        'fecha_emision',
        'fecha_recepcion',
        'fecha_vencimiento',
        'forma_pago',
        'moneda',
        'neto',
        'iva',
        'exento',
        'total',
        'estado',
        'observaciones',
        'pdf_url',
    ];

    public function detalles()
    {
        return $this->hasMany(FacturasCompraDetalle::class, 'factura_compra_id');
    }

    public function getPeriodoAttribute()
    {
        return \Carbon\Carbon::parse($this->fecha_emision)->translatedFormat('F Y');
    }
}

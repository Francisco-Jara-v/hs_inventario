<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaVentaDetalle extends Model
{
    protected $table = 'factura_venta_detalle';

    protected $fillable = [
        'factura_venta_id',
        'descripcion',
        'detalle',
        'cantidad',
        'precio_unitario',
        'descuento',
        'subtotal',
        'afecto_iva',
    ];

    public function facturaVenta()
    {
        return $this->belongsTo(FacturaVenta::class, 'factura_venta_id');
    }


}

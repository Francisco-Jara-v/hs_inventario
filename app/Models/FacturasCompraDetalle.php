<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturasCompraDetalle extends Model
{
    protected $table = 'facturas_compra_detalle';

    protected $fillable = [
        'factura_compra_id',
        'descripcion',
        'cantidad',
        'precio_unitario',
        'descuento',
        'subtotal',
        'afecto_iva',
    ];

    public function factura()
    {
        return $this->belongsTo(FacturaCompra::class, 'factura_compra_id');
    }
}

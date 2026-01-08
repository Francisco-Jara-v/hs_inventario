<?php

namespace App\Models;

use App\Models\FacturaVentaDetalle;

use Illuminate\Database\Eloquent\Model;

class FacturaVenta extends Model
{
    protected $table = 'factura_venta';

    protected $fillable = [
        'cliente_id',
        'factura_referencia_id',
        'tipo_documento',
        'folio',
        'fecha_emision',
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
        return $this->hasMany(FacturaVentaDetalle::class, 'factura_venta_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function facturaReferencia()
    {
        return $this->belongsTo(self::class, 'factura_referencia_id');
    }

    public function notasCredito()
    {
        return $this->hasMany(self::class, 'factura_referencia_id');
    }

    protected static function beforeCreate(array $data): array
    {
        if ($data['tipo_documento'] !== 'NOTA_CREDITO') {
            $data['factura_referencia_id'] = null;
        }
    
        return $data;
    }

    public function scopeEmitidas($query)
    {
        return $query->where('estado', 'EMITIDA');
    }

    public function getPeriodoAttribute()
    {
        return \Carbon\Carbon::parse($this->fecha_emision)->translatedFormat('F Y');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Arriendo extends Model
{

    protected $table = 'arriendos';
    protected $primaryKey = 'Contrato';

    public $incrementing = false; // si el contrato no es autoincremental

    protected $fillable = [
        'ID_Cliente', 'Fecha_inicio', 'Fecha_fin', 'Guia_Despacho', 'Precio_total', 'Estado', 'Observaciones'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'ID_Cliente', 'Id_Clientes');
    }

    public function detalles()
    {
        return $this->hasMany(ArriendoDetalle::class, 'Contrato', 'Contrato');
    }
}

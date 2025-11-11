<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArriendoDetalle extends Model
{
    protected $table = 'arriendo_detalle';
    protected $fillable = [
        'Contrato', 'Equipo_id', 'Equipo_detalle_id', 'Estado', 'Precio_equipo', 'Garantia'
    ];

    public function arriendo()
    {
        return $this->belongsTo(Arriendo::class, 'Contrato', 'Contrato');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'Equipo_id', 'ID_Equipos');
    }
}

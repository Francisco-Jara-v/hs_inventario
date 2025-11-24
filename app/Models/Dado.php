<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dado extends Model
{
    protected $table = 'dados';
    protected $primaryKey = 'id'; // clave primaria
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'Id_Equipo',
        'Equipo',
        'Medida',
        'Cuadrante',
        'Cantidad_disponible',
        'Cantidad_arriendo',
        'Precio',
        'Garantia',
        
    ];
}

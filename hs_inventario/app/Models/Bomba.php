<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bomba extends Model
{
    protected $table = 'bombas';
    protected $primaryKey = 'id'; // clave primaria
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'id_Equipo',
        'Equipo',
        'Marca',
        'Modelo',
        'Serie',
        'Codigo',
        'Precio',
        'Garantia',
        'Estado',
    ];
}

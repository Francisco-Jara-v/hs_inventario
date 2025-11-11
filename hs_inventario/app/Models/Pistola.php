<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pistola extends Model
{
    protected $table = 'pistolas';
    protected $primaryKey = 'id'; // clave primaria
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'Id_Equipo',
        'Equipo',
        'Descripcion',
        'Marca',
        'Modelo',
        'Serie',
        'Codigo',
        'Observacion',
        'Precio',
        'Garantia',
        'Estado',
    ];
}


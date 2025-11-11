<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cilindro extends Model
{
    protected $table = 'cilindros';
    protected $primaryKey = 'id'; // clave primaria
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'Id_Equipo',
        'Equipo',
        'Marca',
        'Modelo',
        'Accion',
        'Toneladas',
        'Altura',
        'Carrera',
        'Precio',
        'Garantia',
        'Estado',
        
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabezal extends Model
{
    use HasFactory;

    protected $table = 'cabezal'; // o 'cabezales', según tu tabla real
    protected $primaryKey = 'id'; // si tu PK tiene otro nombre, cámbialo
    public $timestamps = false;

    protected $fillable = [
        'Id_Equipo',
        'Equipo',
        'Marca',
        'Modelo',
        'Cuadrante',
        'Serie',
        'Codigo',
        'Observacion',
        'Precio',
        'Garantia',
    ];
}

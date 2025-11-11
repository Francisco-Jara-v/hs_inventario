<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Bomba;
use App\Models\Cilindro;
use App\Models\Cabezal;
use App\Models\Dado;
use App\Models\Pistola;

class Equipo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'equipos';
    protected $primaryKey = 'ID_Equipos';
    public $timestamps = false;

    protected $fillable = ['nombre_equipo', 'marca', 'modelo', 'serie'];


    // Relaciones con tablas de detalles
    public function bombas()
    {
        return $this->hasMany(Bomba::class, 'Id_Equipo', 'ID_Equipos');
    }

    public function cilindros()
    {
        return $this->hasMany(Cilindro::class, 'Id_Equipo', 'ID_Equipos');
    }

    public function cabezales()
    {
        return $this->hasMany(Cabezal::class, 'Id_Equipo', 'ID_Equipos');
    }

    public function dados()
    {
        return $this->hasMany(Dado::class, 'Id_Equipo', 'ID_Equipos');
    }

    public function pistolas()
    {
        return $this->hasMany(Pistola::class, 'Id_Equipo', 'ID_Equipos');
    }
}

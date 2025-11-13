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
        protected static function booted()
    {
        static::created(function ($cabezal) {
            // Buscar el tipo de equipo asociado
            $tipoEquipo = \App\Models\Equipo::find($cabezal->Id_Equipo);
        
            if ($tipoEquipo) {
                // Aumentar cantidades
                $tipoEquipo->Cantidad_total = ($tipoEquipo->Cantidad_total ?? 0) + 1;
                
                $tipoEquipo->save();
            }
        });
    
    static::deleted(function ($cabezal) {
        $tipo = \App\Models\Equipo::find($cabezal->Id_Equipo);
        if ($tipo) {
            // Recontar cuántos equipos quedan realmente en la tabla
            $cantidad = \App\Models\Cabezal::where('Id_Equipo', $tipo->ID_Equipos)->count();
            $tipo->Cantidad_total = $cantidad;
            $tipo->save();
        }
    });
    }
}

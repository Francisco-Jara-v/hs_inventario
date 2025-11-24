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
        protected static function booted()
    {
        static::created(function ($pistola) {
            // Buscar el tipo de equipo asociado
            $tipoEquipo = \App\Models\Equipo::find($pistola->Id_Equipo);
        
            if ($tipoEquipo) {
                // Aumentar cantidades
                $tipoEquipo->Cantidad_total = ($tipoEquipo->Cantidad_total ?? 0) + 1;
                
                $tipoEquipo->save();
            }
        });
    
    static::deleted(function ($pistola) {
        $tipo = \App\Models\Equipo::find($pistola->Id_Equipo);
        if ($tipo) {
            // Recontar cuántos equipos quedan realmente en la tabla
            $cantidad = \App\Models\Pistola::where('Id_Equipo', $tipo->ID_Equipos)->count();
            $tipo->Cantidad_total = $cantidad;
            $tipo->save();
        }
    });
    }
}


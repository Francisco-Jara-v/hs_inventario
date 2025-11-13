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
        protected static function booted()
    {
        static::created(function ($cilindro) {
            // Buscar el tipo de equipo asociado
            $tipoEquipo = \App\Models\Equipo::find($cilindro->Id_Equipo);
        
            if ($tipoEquipo) {
                // Aumentar cantidades
                $tipoEquipo->Cantidad_total = ($tipoEquipo->Cantidad_total ?? 0) + 1;
                
                $tipoEquipo->save();
            }
        });
    
    static::deleted(function ($cilindro) {
        $tipo = \App\Models\Equipo::find($cilindro->Id_Equipo);
        if ($tipo) {
            // Recontar cuántos equipos quedan realmente en la tabla
            $cantidad = \App\Models\Cilindro::where('Id_Equipo', $tipo->ID_Equipos)->count();
            $tipo->Cantidad_total = $cantidad;
            $tipo->save();
        }
    });
    }
}

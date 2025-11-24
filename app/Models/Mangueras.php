<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mangueras extends Model
{
    protected $table = 'mangueras';
    protected $primaryKey = 'id'; // clave primaria
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'Id_Equipo',
        'Equipo',
        'Observacion',
        'Cantidad_disponible',
        'Cantidad_arriendo',
        'Precio',
        'Garantia',
        
    ];
    protected static function booted()
    {
        static::created(function ($manguera) {
            // Buscar el tipo de equipo asociado
            $tipoEquipo = \App\Models\Equipo::find($manguera->Id_Equipo);
        
            if ($tipoEquipo) {
                // Aumentar cantidades
                $tipoEquipo->Cantidad_total = ($tipoEquipo->Cantidad_total ?? 0) + 1;
                
                $tipoEquipo->save();
            }
        });
    
    static::deleted(function ($manguera) {
        $tipo = \App\Models\Equipo::find($manguera->Id_Equipo);
        if ($tipo) {
            // Recontar cuántos equipos quedan realmente en la tabla
            $cantidad = \App\Models\Mangueras::where('Id_Equipo', $tipo->ID_Equipos)->count();
            $tipo->Cantidad_total = $cantidad;
            $tipo->save();
        }
    });
    }
}

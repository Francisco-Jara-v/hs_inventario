<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LlavesTorque extends Model
{
    protected $table = 'llaves_torques';
    protected $primaryKey = 'id'; // clave primaria
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'Id_Equipo',
        'Equipo',
        'Marca',
        'Modelo',
        'Serie',
        'Cuadrante',
        'Torque',
        'Precio',
        'Garantia',
        'Estado,'
        
    ];
    protected static function booted()
    {
        static::created(function ($llavestorque) {
            // Buscar el tipo de equipo asociado
            $tipoEquipo = \App\Models\Equipo::find($llavestorque->Id_Equipo);
        
            if ($tipoEquipo) {
                // Aumentar cantidades
                $tipoEquipo->Cantidad_total = ($tipoEquipo->Cantidad_total ?? 0) + 1;
                
                $tipoEquipo->save();
            }
        });
    
    static::deleted(function ($llavestorque) {
        $tipo = \App\Models\Equipo::find($llavestorque->Id_Equipo);
        if ($tipo) {
            // Recontar cuántos equipos quedan realmente en la tabla
            $cantidad = \App\Models\LlavesTorque::where('Id_Equipo', $tipo->ID_Equipos)->count();
            $tipo->Cantidad_total = $cantidad;
            $tipo->save();
        }
    });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArriendoDetalle extends Model
{
    use HasFactory;
    protected $table = 'arriendo_detalle';
    protected $fillable = [
        'Contrato',
        'Equipo_id', 
        'Equipo_detalle_id', 
        'Estado', 
        'Precio_equipo', 
        'Garantia'
    ];

    public function arriendo()
    {
        return $this->belongsTo(Arriendo::class, 'Contrato', 'Contrato');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'Equipo_id', 'ID_Equipos');
    }




    protected static function booted()
    {
        static::created(function ($detalle) {
            // Detectar el tipo de equipo (bomba, cabezal, etc.)
            $nombreEquipo = strtolower(Equipo::where('ID_Equipos', $detalle->Equipo_id)->value('Nombre_equipos'));
            
            $modelo = match ($nombreEquipo) {
                'bomba' => \App\Models\Bomba::class,
                'cabezal' => \App\Models\Cabezal::class,
                'cilindro' => \App\Models\Cilindro::class,
                'dado' => \App\Models\Dado::class,
                'llave torque' => \App\Models\LlavesTorque::class,
                'mangueras' => \App\Models\Mangueras::class,
                'pistola' => \App\Models\Pistola::class,
                default => null,
            };

            if ($modelo) {
        $equipo = $modelo::find($detalle->Equipo_detalle_id);

        if ($equipo) {
            //  Caso especial: Dado (sin columna Estado)
            if ($modelo === \App\Models\Dado::class) {
                $equipo->Cantidad_disponible = max(0, $equipo->Cantidad_disponible - 1);
                $equipo->Cantidad_arriendo = ($equipo->Cantidad_arriendo ?? 0) + 1;
                $equipo->save();
            }
            elseif ($modelo === \App\Models\Mangueras::class) {
                $equipo->Cantidad_disponible = max(0, $equipo->Cantidad_disponible - 1);
                $equipo->Cantidad_arriendo = ($equipo->Cantidad_arriendo ?? 0) + 1;
                $equipo->save();
            } else {
                //  Equipos normales: actualizar estado
                if (property_exists($equipo, 'Estado') || isset($equipo->Estado)) {
                    $equipo->Estado = 'En arriendo';
                    $equipo->save();
                }
            }
        }
    }});

            

static::updated(function ($detalle) {

    $estadoOriginal = $detalle->getOriginal('Estado');
    $estadoNuevo = $detalle->Estado;

    // SOLO ejecutar si realmente cambia de En arriendo → Finalizado
    if (
        strtolower($estadoOriginal) === 'En arriendo' &&
        strtolower($estadoNuevo) === 'En stock'
    ) {

        $nombreEquipo = strtolower(Equipo::where('ID_Equipos', $detalle->Equipo_id)->value('Nombre_equipos'));

        $modelo = match ($nombreEquipo) {
            'bomba' => \App\Models\Bomba::class,
            'cabezal' => \App\Models\Cabezal::class,
            'cilindro' => \App\Models\Cilindro::class,
            'dado' => \App\Models\Dado::class,
            'llave torque' => \App\Models\LlavesTorque::class,
            'mangueras' => \App\Models\Mangueras::class,
            'pistola' => \App\Models\Pistola::class,
            default => null,
        };

        if ($modelo) {
            $equipo = $modelo::find($detalle->Equipo_detalle_id);

            if ($equipo) {
                if ($modelo === \App\Models\Dado::class || $modelo === \App\Models\Mangueras::class) {
                    $equipo->Cantidad_disponible += 1;
                    $equipo->Cantidad_arriendo = max(0, $equipo->Cantidad_arriendo - 1);
                    $equipo->save();
                } else {
                    // Equipos con estado
                    $equipo->Estado = 'En stock';
                    $equipo->save();
                }
            }
        }
    }
});}
}

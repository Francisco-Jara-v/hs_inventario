<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Arriendo extends Model
{

    protected $table = 'arriendos';
    protected $primaryKey = 'Contrato';

    public $incrementing = true; // si el contrato no es autoincremental

    protected $fillable = [
        'ID_Cliente', 'Fecha_inicio', 'Fecha_fin', 'Guia_Despacho', 'Precio_total', 'Estado', 'Observaciones'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'ID_Cliente', 'ID_Clientes');
    }

    public function detalles()
    {
        return $this->hasMany(ArriendoDetalle::class, 'Contrato', 'Contrato');
    }

    protected static function booted()
    {
        static::updated(function ($arriendo) {
                if ($arriendo->isDirty('Estado') && $arriendo->Estado === 'Finalizado') {
                
                    foreach ($arriendo->detalles as $detalle) {
                        $tipoEquipo = strtolower($detalle->equipo->Nombre_equipos ?? '');
                    
                        $modelo = match ($tipoEquipo) {
                            'bomba' => \App\Models\Bomba::find($detalle->Equipo_detalle_id),
                            'cabezal' => \App\Models\Cabezal::find($detalle->Equipo_detalle_id),
                            'cilindro' => \App\Models\Cilindro::find($detalle->Equipo_detalle_id),
                            'dado' => \App\Models\Dado::find($detalle->Equipo_detalle_id),
                            'pistola' => \App\Models\Pistola::find($detalle->Equipo_detalle_id),
                            default => null,
                        };
                    
                        if ($modelo) {
                            $equipo = $modelo::find($detalle->Equipo_detalle_id);

                            if ($equipo) {
                                // ✅ Caso especial: Dado (sin columna Estado)
                                if ($modelo === \App\Models\Dado::class) {
                                    $equipo->Cantidad_disponible = max(0, $equipo->Cantidad_disponible + 1);
                                    $equipo->Cantidad_arriendo = ($equipo->Cantidad_arriendo ?? 0) - 1;
                                    $equipo->save();
                                } else {
                                    // ✅ Equipos normales: actualizar estado
                                    if (property_exists($equipo, 'Estado') || isset($equipo->Estado)) {
                                        $equipo->Estado = 'En stock';
                                        $equipo->save();
                                    }
                                }
                            }
                        }
                    }
                }
            });
    }

}

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

                // DEVOLVER LA CLASE, NO EL REGISTRO
                $modelo = match ($tipoEquipo) {
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

                        // DADOS y MANGUERAS
                        if ($modelo === \App\Models\Dado::class || $modelo === \App\Models\Mangueras::class) {
                            $equipo->Cantidad_disponible = max(0, $equipo->Cantidad_disponible + 1);
                            $equipo->Cantidad_arriendo = max(0, ($equipo->Cantidad_arriendo - 1));
                            $equipo->save();
                        }

                        // EQUIPOS QUE USAN ESTADO
                        else {
                            if (isset($equipo->Estado)) {
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

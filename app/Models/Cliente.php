<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'ID_Clientes'; // clave primaria
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'Empresa',
        'Rut',
        'Telefono',
        'Correo',
        'Direccion',
    ];
}

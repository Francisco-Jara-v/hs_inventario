<?php

namespace App\Filament\Resources\Equipos\Pages;

use App\Filament\Resources\Equipos\EquiposResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEquipos extends CreateRecord
{
    protected static string $resource = EquiposResource::class;
        //FUNCION PARA REDIRECCIONAR AL INDEX DEL MODULO
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

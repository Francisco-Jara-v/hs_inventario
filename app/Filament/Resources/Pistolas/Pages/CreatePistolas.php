<?php

namespace App\Filament\Resources\Pistolas\Pages;

use App\Filament\Resources\Pistolas\PistolasResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePistolas extends CreateRecord
{
    protected static string $resource = PistolasResource::class;
        //FUNCION PARA REDIRECCIONAR AL INDEX DEL MODULO
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

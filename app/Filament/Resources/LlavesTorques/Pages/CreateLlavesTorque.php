<?php

namespace App\Filament\Resources\LlavesTorques\Pages;

use App\Filament\Resources\LlavesTorques\LlavesTorqueResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLlavesTorque extends CreateRecord
{
    protected static string $resource = LlavesTorqueResource::class;
        //FUNCION PARA REDIRECCIONAR AL INDEX DEL MODULO
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

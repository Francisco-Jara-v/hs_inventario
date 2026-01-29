<?php

namespace App\Filament\Resources\Cabezales\Pages;

use App\Filament\Resources\Cabezales\CabezalesResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCabezales extends CreateRecord
{
    protected static string $resource = CabezalesResource::class;
        //FUNCION PARA REDIRECCIONAR AL INDEX DEL MODULO
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

<?php

namespace App\Filament\Resources\Cilindros\Pages;

use App\Filament\Resources\Cilindros\CilindroResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCilindro extends CreateRecord
{
    protected static string $resource = CilindroResource::class;
        //FUNCION PARA REDIRECCIONAR AL INDEX DEL MODULO
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

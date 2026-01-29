<?php

namespace App\Filament\Resources\Dados\Pages;

use App\Filament\Resources\Dados\DadosResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDados extends CreateRecord
{
    protected static string $resource = DadosResource::class;
        //FUNCION PARA REDIRECCIONAR AL INDEX DEL MODULO
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

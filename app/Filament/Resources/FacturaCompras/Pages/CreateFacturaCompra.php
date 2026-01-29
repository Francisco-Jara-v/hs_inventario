<?php

namespace App\Filament\Resources\FacturaCompras\Pages;

use App\Filament\Resources\FacturaCompras\FacturaCompraResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions;

class CreateFacturaCompra extends CreateRecord
{
    protected static string $resource = FacturaCompraResource::class;
        //FUNCION PARA REDIRECCIONAR AL INDEX DEL MODULO
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}

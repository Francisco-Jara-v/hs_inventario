<?php

namespace App\Filament\Resources\FacturaCompras\Pages;

use App\Filament\Resources\FacturaCompras\FacturaCompraResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditFacturaCompra extends EditRecord
{
    protected static string $resource = FacturaCompraResource::class;
        //FUNCION PARA REDIRECCIONAR AL INDEX DEL MODULO
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            viewAction::make(),
            DeleteAction::make(),
        ];
    }
}

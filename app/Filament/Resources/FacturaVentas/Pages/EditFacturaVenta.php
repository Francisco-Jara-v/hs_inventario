<?php

namespace App\Filament\Resources\FacturaVentas\Pages;

use App\Filament\Resources\FacturaVentas\FacturaVentaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFacturaVenta extends EditRecord
{
    protected static string $resource = FacturaVentaResource::class;
        //FUNCION PARA REDIRECCIONAR AL INDEX DEL MODULO
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

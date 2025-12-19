<?php

namespace App\Filament\Resources\FacturaCompras\Pages;

use App\Filament\Resources\FacturaCompras\FacturaCompraResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFacturaCompras extends ListRecords
{
    protected static string $resource = FacturaCompraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Registrar Factura de Compra')
            ->modalHeading('Registrar Factura de Compra')
            ->modalWidth('7xl') // importante para formularios grandes
            ->createAnother(false),
        ];
    }
}

<?php

namespace App\Filament\Resources\FacturaCompras\Pages;

use App\Filament\Resources\FacturaCompras\FacturaCompraResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFacturaCompra extends ViewRecord
{
    protected static string $resource = FacturaCompraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

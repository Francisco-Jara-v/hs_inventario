<?php

namespace App\Filament\Resources\Cilindros\Pages;

use App\Filament\Resources\Cilindros\CilindroResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCilindro extends ViewRecord
{
    protected static string $resource = CilindroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

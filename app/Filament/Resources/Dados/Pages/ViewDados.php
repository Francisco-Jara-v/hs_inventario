<?php

namespace App\Filament\Resources\Dados\Pages;

use App\Filament\Resources\Dados\DadosResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDados extends ViewRecord
{
    protected static string $resource = DadosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

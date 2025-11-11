<?php

namespace App\Filament\Resources\Dados\Pages;

use App\Filament\Resources\Dados\DadosResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDados extends ListRecords
{
    protected static string $resource = DadosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

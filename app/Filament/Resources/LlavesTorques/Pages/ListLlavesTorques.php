<?php

namespace App\Filament\Resources\LlavesTorques\Pages;

use App\Filament\Resources\LlavesTorques\LlavesTorqueResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLlavesTorques extends ListRecords
{
    protected static string $resource = LlavesTorqueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\LlavesTorques\Pages;

use App\Filament\Resources\LlavesTorques\LlavesTorqueResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLlavesTorque extends EditRecord
{
    protected static string $resource = LlavesTorqueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

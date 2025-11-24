<?php

namespace App\Filament\Resources\Cilindros\Pages;

use App\Filament\Resources\Cilindros\CilindroResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCilindro extends EditRecord
{
    protected static string $resource = CilindroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\LlavesTorques;

use App\Filament\Resources\LlavesTorques\Pages\CreateLlavesTorque;
use App\Filament\Resources\LlavesTorques\Pages\EditLlavesTorque;
use App\Filament\Resources\LlavesTorques\Pages\ListLlavesTorques;
use App\Filament\Resources\LlavesTorques\Schemas\LlavesTorqueForm;
use App\Filament\Resources\LlavesTorques\Tables\LlavesTorquesTable;
use App\Models\LlavesTorque;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LlavesTorqueResource extends Resource
{
    protected static ?string $model = LlavesTorque::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $recordTitleAttribute = 'Llave_torque';

    public static function form(Schema $schema): Schema
    {
        return LlavesTorqueForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LlavesTorquesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLlavesTorques::route('/'),
            'create' => CreateLlavesTorque::route('/create'),
            'edit' => EditLlavesTorque::route('/{record}/edit'),
        ];
    }
}

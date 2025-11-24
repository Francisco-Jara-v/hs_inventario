<?php

namespace App\Filament\Resources\Mangueras;

use App\Filament\Resources\Mangueras\Pages\CreateMangueras;
use App\Filament\Resources\Mangueras\Pages\EditMangueras;
use App\Filament\Resources\Mangueras\Pages\ListMangueras;
use App\Filament\Resources\Mangueras\Schemas\ManguerasForm;
use App\Filament\Resources\Mangueras\Tables\ManguerasTable;
use App\Models\Mangueras;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ManguerasResource extends Resource
{
    protected static ?string $model = Mangueras::class;

    protected static bool $shouldRegisterNavigation = false;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Manguera';

    public static function form(Schema $schema): Schema
    {
        return ManguerasForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ManguerasTable::configure($table);
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
            'index' => ListMangueras::route('/'),
            'create' => CreateMangueras::route('/create'),
            'edit' => EditMangueras::route('/{record}/edit'),
        ];
    }
}

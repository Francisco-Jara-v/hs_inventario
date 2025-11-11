<?php

namespace App\Filament\Resources\Bombas;

use App\Filament\Resources\Bombas\Pages\CreateBomba;
use App\Filament\Resources\Bombas\Pages\EditBomba;
use App\Filament\Resources\Bombas\Pages\ListBombas;
use App\Filament\Resources\Bombas\Pages\ViewBomba;
use App\Filament\Resources\Bombas\Schemas\BombaForm;
use App\Filament\Resources\Bombas\Schemas\BombaInfolist;
use App\Filament\Resources\Bombas\Tables\BombasTable;
use App\Models\Bomba;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BombaResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $model = Bomba::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Bomba';

    public static function form(Schema $schema): Schema
    {
        return BombaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BombaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BombasTable::configure($table);
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
            'index' => ListBombas::route('/'),
            'create' => CreateBomba::route('/create'),
            'view' => ViewBomba::route('/{record}'),
            'edit' => EditBomba::route('/{record}/edit'),
        ];
    }
}

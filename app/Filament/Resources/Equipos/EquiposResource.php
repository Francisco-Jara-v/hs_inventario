<?php

namespace App\Filament\Resources\Equipos;

use App\Filament\Resources\Equipos\Pages\CreateEquipos;
use App\Filament\Resources\Equipos\Pages\EditEquipos;
use App\Filament\Resources\Equipos\Pages\ListEquipos;
use App\Filament\Resources\Equipos\Pages\ViewEquipos;
use App\Filament\Resources\Equipos\Schemas\EquiposForm;
use App\Filament\Resources\Equipos\Schemas\EquiposInfolist;
use App\Filament\Resources\Equipos\Tables\EquiposTable;
use App\Models\Equipos;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class EquiposResource extends Resource
{
    protected static ?string $model = Equipos::class;

    protected static string | UnitEnum | null $navigationGroup = 'Inventario';

    protected static ?string $navigationLabel = 'Equipos';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    protected static ?string $recordTitleAttribute = 'Equipos';

    public static function form(Schema $schema): Schema
    {
        return EquiposForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EquiposInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EquiposTable::configure($table);
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
            'index' => ListEquipos::route('/'),
            'create' => CreateEquipos::route('/create'),
            'view' => ViewEquipos::route('/{record}'),
            'edit' => EditEquipos::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}

<?php

namespace App\Filament\Resources\Cabezales;

use App\Filament\Resources\Cabezales\Pages\CreateCabezales;
use App\Filament\Resources\Cabezales\Pages\EditCabezales;
use App\Filament\Resources\Cabezales\Pages\ListCabezales;
use App\Filament\Resources\Cabezales\Pages\ViewCabezales;
use App\Filament\Resources\Cabezales\Schemas\CabezalesForm;
use App\Filament\Resources\Cabezales\Schemas\CabezalesInfolist;
use App\Filament\Resources\Cabezales\Tables\CabezalesTable;
use App\Models\Cabezal;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CabezalesResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $model = Cabezal::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Cabezal';

    protected static ?string $modelLabel = 'Cabezales';

    public static function form(Schema $schema): Schema
    {
        return CabezalesForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CabezalesInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CabezalesTable::configure($table);
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
            'index' => ListCabezales::route('/'),
            'create' => CreateCabezales::route('/create'),
            'view' => ViewCabezales::route('/{record}'),
            'edit' => EditCabezales::route('/{record}/edit'),
        ];
    }

 
}

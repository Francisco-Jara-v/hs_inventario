<?php

namespace App\Filament\Resources\Pistolas;

use App\Filament\Resources\Pistolas\Pages\CreatePistolas;
use App\Filament\Resources\Pistolas\Pages\EditPistolas;
use App\Filament\Resources\Pistolas\Pages\ListPistolas;
use App\Filament\Resources\Pistolas\Pages\ViewPistolas;
use App\Filament\Resources\Pistolas\Schemas\PistolasForm;
use App\Filament\Resources\Pistolas\Schemas\PistolasInfolist;
use App\Filament\Resources\Pistolas\Tables\PistolasTable;
use App\Models\Pistola;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use SoftDeletes;

class PistolasResource extends Resource
{
    
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $model = Pistola::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Pistola';

    public static function form(Schema $schema): Schema
    {
        return PistolasForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PistolasInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PistolasTable::configure($table);
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
            'index' => ListPistolas::route('/'),
            'create' => CreatePistolas::route('/create'),
            'view' => ViewPistolas::route('/{record}'),
            'edit' => EditPistolas::route('/{record}/edit'),
        ];
    }

    
}

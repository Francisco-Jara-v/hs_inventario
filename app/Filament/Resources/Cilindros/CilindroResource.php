<?php

namespace App\Filament\Resources\Cilindros;

use App\Filament\Resources\Cilindros\Pages\CreateCilindro;
use App\Filament\Resources\Cilindros\Pages\EditCilindro;
use App\Filament\Resources\Cilindros\Pages\ListCilindros;
use App\Filament\Resources\Cilindros\Pages\ViewCilindro;
use App\Filament\Resources\Cilindros\Schemas\CilindroForm;
use App\Filament\Resources\Cilindros\Schemas\CilindroInfolist;
use App\Filament\Resources\Cilindros\Tables\CilindrosTable;
use App\Models\Cilindro;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CilindroResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $model = Cilindro::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Cilindro';

    public static function form(Schema $schema): Schema
    {
        return CilindroForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CilindroInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CilindrosTable::configure($table);
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
            'index' => ListCilindros::route('/'),
            'create' => CreateCilindro::route('/create'),
            'view' => ViewCilindro::route('/{record}'),
            'edit' => EditCilindro::route('/{record}/edit'),
        ];
    }
}

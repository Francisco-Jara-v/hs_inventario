<?php

namespace App\Filament\Resources\Dados;

use App\Filament\Resources\Dados\Pages\CreateDados;
use App\Filament\Resources\Dados\Pages\EditDados;
use App\Filament\Resources\Dados\Pages\ListDados;
use App\Filament\Resources\Dados\Pages\ViewDados;
use App\Filament\Resources\Dados\Schemas\DadosForm;
use App\Filament\Resources\Dados\Schemas\DadosInfolist;
use App\Filament\Resources\Dados\Tables\DadosTable;
use App\Models\Dado;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DadosResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $model = Dado::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Dado';

    public static function form(Schema $schema): Schema
    {
        return DadosForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DadosInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DadosTable::configure($table);
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
            'index' => ListDados::route('/'),
            'create' => CreateDados::route('/create'),
            'view' => ViewDados::route('/{record}'),
            'edit' => EditDados::route('/{record}/edit'),
        ];
    }

}

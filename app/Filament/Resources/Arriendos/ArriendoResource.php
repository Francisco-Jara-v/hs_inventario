<?php

namespace App\Filament\Resources\Arriendos;

use App\Filament\Resources\Arriendos\Pages\CreateArriendo;
use App\Filament\Resources\Arriendos\Pages\EditArriendo;
use App\Filament\Resources\Arriendos\Pages\ListArriendos;
use App\Filament\Resources\Arriendos\Pages\ViewArriendo;
use App\Filament\Resources\Arriendos\Schemas\ArriendoInfolist;
use App\Filament\Resources\Arriendos\Tables\ArriendosTable;
use App\Models\Arriendo;

use BackedEnum;
use Filament\Support\Icons\Heroicon;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use App\Filament\Resources\Arriendos\Schemas\ArriendoForm;



class ArriendoResource extends Resource
{
    protected static ?string $model = Arriendo::class;

    // 🔧 corregido el tipo del icono
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboard;

    protected static ?string $recordTitleAttribute = 'Contrato';

    public static function form(Schema $schema): Schema
    {
        return ArriendoForm::configure($schema);
    }
    public static function infolist(Schema $schema): Schema
    {
        return ArriendoInfolist::configure($schema);
    }

    public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return ArriendosTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArriendos::route('/'),
            'create' => CreateArriendo::route('/create'),
            'view' => ViewArriendo::route('/{record}'),
            'edit' => EditArriendo::route('/{record}/edit'),
        ];
    }
}

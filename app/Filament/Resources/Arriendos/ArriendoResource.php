<?php

namespace App\Filament\Resources\Arriendos;

use App\Filament\Resources\Arriendos\Pages\CreateArriendo;
use App\Filament\Resources\Arriendos\Pages\EditArriendo;
use App\Filament\Resources\Arriendos\Pages\ListArriendos;
use App\Filament\Resources\Arriendos\Pages\ViewArriendo;
use App\Filament\Resources\Arriendos\Schemas\ArriendoInfolist;
use App\Filament\Resources\Arriendos\Tables\ArriendosTable;
use App\Filament\Resources\Arriendos\Schemas\ArriendoForm;
use App\Models\Arriendo;
use App\Models\Cliente;
use App\Models\Equipo;
use App\Models\Dado;
use App\Models\Bomba;
use App\Models\Cilindro;
use App\Models\Cabezal;
use App\Models\Pistola;
use BackedEnum;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms;

use Filament\Schemas\Components\Form;



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

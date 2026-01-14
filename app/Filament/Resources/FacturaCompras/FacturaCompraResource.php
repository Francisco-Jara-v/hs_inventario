<?php

namespace App\Filament\Resources\FacturaCompras;

use App\Filament\Resources\FacturaCompras\Pages\CreateFacturaCompra;
use App\Filament\Resources\FacturaCompras\Pages\EditFacturaCompra;
use App\Filament\Resources\FacturaCompras\Pages\ListFacturaCompras;
use App\Filament\Resources\FacturaCompras\Pages\ViewFacturaCompra;
use App\Filament\Resources\FacturaCompras\Schemas\FacturaCompraForm;
use App\Filament\Resources\FacturaCompras\Schemas\FacturaCompraInfolist;
use App\Filament\Resources\FacturaCompras\Tables\FacturaComprasTable;
use App\Models\FacturaCompra;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Navigation\NavigationGroup;
use UnitEnum;


class FacturaCompraResource extends Resource
{
    protected static ?string $model = FacturaCompra::class;
    
    protected static string | UnitEnum | null $navigationGroup = 'Administración';

    protected static ?string $navigationLabel = 'Registro de Compras';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;


    protected static ?string $recordTitleAttribute = 'folio';

    public static function form(Schema $schema): Schema
    {
        return FacturaCompraForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FacturaCompraInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FacturaComprasTable::configure($table);
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
            'index' => ListFacturaCompras::route('/'),
            'create' => CreateFacturaCompra::route('/create'),
            'view' => ViewFacturaCompra::route('/{record}'),
            'edit' => EditFacturaCompra::route('/{record}/edit'),
        ];
    }
}

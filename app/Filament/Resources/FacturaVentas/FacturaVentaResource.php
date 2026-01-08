<?php

namespace App\Filament\Resources\FacturaVentas;

use App\Filament\Resources\FacturaVentas\Pages\CreateFacturaVenta;
use App\Filament\Resources\FacturaVentas\Pages\EditFacturaVenta;
use App\Filament\Resources\FacturaVentas\Pages\ListFacturaVentas;
use App\Filament\Resources\FacturaVentas\Schemas\FacturaVentaForm;
use App\Filament\Resources\FacturaVentas\Tables\FacturaVentasTable;
use App\Models\FacturaVenta;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class FacturaVentaResource extends Resource
{
    protected static ?string $model = FacturaVenta::class;
    
    protected static string | UnitEnum | null $navigationGroup = 'Administración';

    protected static ?string $navigationLabel = 'Registro de Ventas';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $recordTitleAttribute = 'FacturaVenta';

    public static function form(Schema $schema): Schema
    {
        return FacturaVentaForm::configure($schema);

    }

    public static function table(Table $table): Table
    {
        return FacturaVentasTable::configure($table);
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
            'index' => ListFacturaVentas::route('/'),
            'create' => CreateFacturaVenta::route('/create'),
            'edit' => EditFacturaVenta::route('/{record}/edit'),

        ];
    }
}

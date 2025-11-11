<?php

namespace App\Filament\Resources\Equipos;

use App\Filament\Resources\Equipos\Pages\CreateEquipo;
use App\Filament\Resources\Equipos\Pages\EditEquipo;
use App\Filament\Resources\Equipos\Pages\ListEquipos;
use App\Filament\Resources\Equipos\Pages\ViewEquipo;
use App\Filament\Resources\Equipos\Schemas\EquipoForm;
use App\Filament\Resources\Equipos\Schemas\EquipoInfolist;
use App\Filament\Resources\Equipos\Tables\EquiposTable;
use App\Models\Equipo;
use BackedEnum;
use Filament\Actions\Action;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EquipoResource extends Resource
{
    protected static ?string $model = Equipo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Nombre_equipos';

    public static function form(Schema $schema): Schema
    {
        return EquipoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EquipoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Nombre_equipos')->label('Tipo'),
                TextColumn::make('Descripcion'),
                TextColumn::make('Cantidad_total'),  
            ])
            ->actions([
                Action::make('ver')
                    ->label('Ver')
                    ->button() // opcional, para que se vea como botón
                    ->url(fn($record) => match($record->Nombre_equipos) {
                        'Bomba' => route('filament.admin.resources.bombas.index'),
                        'Cilindro' => route('filament.admin.resources.cilindros.index'),
                        'Cabezal' => route('filament.admin.resources.cabezales.index'),
                        'Dado' => route('filament.admin.resources.dados.index'),
                        'Pistola' => route('filament.admin.resources.pistolas.index'),
                        default => '#',
                    }),
                ])
                ->recordUrl(fn($record) => match($record->Nombre_equipos) {
                    'Bomba' => route('filament.admin.resources.bombas.index'),
                    'Cilindro' => route('filament.admin.resources.cilindros.index'),
                    'Cabezal' => route('filament.admin.resources.cabezales.index'),
                    'Dado' => route('filament.admin.resources.dados.index'),
                    'Pistola' => route('filament.admin.resources.pistolas.index'),
                    default => null,
                })
            ->filters([
                //
            ])
            ->defaultSort('Nombre_equipos');
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
            'create' => CreateEquipo::route('/create'),
            'view' => ViewEquipo::route('/{record}'),
            'edit' => EditEquipo::route('/{record}/edit'),
        ];
    }

    
}

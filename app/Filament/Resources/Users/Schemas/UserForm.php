<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required(),
                Select::make('roles')
                ->label('Rol')
                ->options(Role::pluck('name', 'name'))
                ->required()
                ->visible(fn () => auth()->user()->hasRole('admin')) // solo admin ve el campo
                ->afterStateHydrated(function ($record, callable $set) {
                    if ($record) {
                        $set('roles', $record->roles->pluck('name')->first());
                    }
                })
                ->dehydrated(false) // no guarda en tabla users
            ]);
    }
}

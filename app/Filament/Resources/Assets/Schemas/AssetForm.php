<?php

namespace App\Filament\Resources\Assets\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AssetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('percentage')
                    ->required()
                    ->numeric(),
                TextInput::make('color'),
            ]);
    }
}

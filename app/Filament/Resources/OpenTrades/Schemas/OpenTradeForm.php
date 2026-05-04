<?php

namespace App\Filament\Resources\OpenTrades\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class OpenTradeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('pair')
                    ->required(),
                TextInput::make('timeframe')
                    ->required(),
                FileUpload::make('image_path')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
                    ->directory('open-trades')
                    ->visibility('public'),
                Textarea::make('analysis')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('entry_price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('target_price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('stop_loss')
                    ->required()
                    ->numeric(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}

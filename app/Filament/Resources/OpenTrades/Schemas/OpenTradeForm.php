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
                \Filament\Schemas\Components\Section::make('Trade Information')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(2)
                            ->schema([
                                TextInput::make('pair')
                                    ->required()
                                    ->placeholder('e.g. XAUUSD, BTCUSD'),
                                TextInput::make('timeframe')
                                    ->required()
                                    ->placeholder('e.g. H1, M15'),
                            ]),
                        
                        FileUpload::make('image_path')
                            ->image()
                            ->directory('open-trades')
                            ->visibility('public')
                            ->columnSpanFull(),

                        Textarea::make('analysis')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        \Filament\Schemas\Components\Grid::make(3)
                            ->schema([
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
                                    ->numeric()
                                    ->prefix('$'),
                            ]),

                        Toggle::make('is_active')
                            ->label('Active Position')
                            ->default(true),
                    ])->columns(1),
            ]);
    }
}

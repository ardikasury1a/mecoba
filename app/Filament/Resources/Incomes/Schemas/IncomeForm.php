<?php

namespace App\Filament\Resources\Incomes\Schemas;

use Filament\Schemas\Schema;

class IncomeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Income Details')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('amount')
                            ->numeric()
                            ->prefix('IDR')
                            ->required(),
                        \Filament\Forms\Components\TextInput::make('category')
                            ->required()
                            ->placeholder('e.g. Scalping Profit, Dividends'),
                        \Filament\Forms\Components\DatePicker::make('entry_date')
                            ->default(now())
                            ->required(),
                        \Filament\Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}

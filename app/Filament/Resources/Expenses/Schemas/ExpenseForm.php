<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Expense Details')
                    ->schema([
                        TextInput::make('amount')
                            ->numeric()
                            ->prefix('IDR')
                            ->required(),
                        TextInput::make('category')
                            ->required()
                            ->placeholder('e.g. Stop Loss, Broker Fee'),
                        DatePicker::make('entry_date')
                            ->default(now())
                            ->required(),
                        Textarea::make('description')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Incomes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class IncomesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('entry_date')
                    ->date()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('amount')
                    ->money('IDR')
                    ->sortable()
                    ->color('success'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

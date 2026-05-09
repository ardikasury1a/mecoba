<?php

namespace App\Filament\Resources\OpenTrades\Tables;

use App\Models\Expense;
use App\Models\Income;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OpenTradesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pair')
                    ->searchable(),
                TextColumn::make('timeframe')
                    ->searchable(),
                ImageColumn::make('image_path'),
                TextColumn::make('entry_price')
                    ->money()
                    ->sortable(),
                TextColumn::make('target_price')
                    ->money()
                    ->sortable(),
                TextColumn::make('stop_loss')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('closeTrade')
                    ->label('Close Trade')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->is_active)
                    ->form([
                        TextInput::make('profit_loss')
                            ->label('Final P/L Amount')
                            ->numeric()
                            ->required()
                            ->helperText('Use positive for profit, negative for loss.')
                            ->prefix('$'),
                    ])
                    ->action(function ($record, array $data) {
                        $amount = (float) $data['profit_loss'];
                        
                        if ($amount >= 0) {
                            Income::create([
                                'amount' => $amount,
                                'category' => $record->pair,
                                'entry_date' => now(),
                                'description' => 'Closed Trade: ' . $record->pair . ' (Entry: ' . $record->entry_price . ')',
                            ]);
                        } else {
                            Expense::create([
                                'amount' => abs($amount),
                                'category' => $record->pair,
                                'entry_date' => now(),
                                'description' => 'Closed Trade (Loss): ' . $record->pair . ' (Entry: ' . $record->entry_price . ')',
                            ]);
                        }

                        $record->update(['is_active' => false]);
                        
                        Notification::make()
                            ->title('Trade Closed Successfully')
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $totalIncome = \App\Models\Income::sum('amount');
        $totalExpense = \App\Models\Expense::sum('amount');
        $balance = $totalIncome - $totalExpense;

        return [
            Stat::make('Total Pemasukan (Profit)', 'IDR ' . number_format($totalIncome, 0, ',', '.'))
                ->description('Total profit from trading')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->url(\App\Filament\Resources\Incomes\IncomeResource::getUrl())
                ->color('success'),
            Stat::make('Total Pengeluaran (Loss)', 'IDR ' . number_format($totalExpense, 0, ',', '.'))
                ->description('Total loss and fees')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->url(\App\Filament\Resources\Expenses\ExpenseResource::getUrl())
                ->color('danger'),
            Stat::make('Net Balance', 'IDR ' . number_format($balance, 0, ',', '.'))
                ->description('Current portfolio balance')
                ->descriptionIcon('heroicon-m-banknotes')
                ->url(\App\Filament\Resources\Assets\AssetResource::getUrl())
                ->color($balance >= 0 ? 'success' : 'danger'),
        ];
    }
}

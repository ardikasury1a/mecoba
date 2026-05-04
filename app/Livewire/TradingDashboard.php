<?php

namespace App\Livewire;

use Livewire\Component;

class TradingDashboard extends Component
{
    public $filter = 'all';

    public function render()
    {
        $totalIncome = \App\Models\Income::sum('amount');
        $totalExpense = \App\Models\Expense::sum('amount');
        $balance = $totalIncome - $totalExpense;

        $recentTransactions = collect()
            ->when($this->filter === 'all' || $this->filter === 'profit', fn($c) => $c->concat(\App\Models\Income::latest()->take(5)->get()->map(fn($i) => [
                'type' => 'income',
                'title' => $i->category,
                'amount' => $i->amount,
                'date' => $i->entry_date,
                'icon' => 'heroicon-o-plus-circle',
                'color' => 'text-accent-500'
            ])))
            ->when($this->filter === 'all' || $this->filter === 'loss', fn($c) => $c->concat(\App\Models\Expense::latest()->take(5)->get()->map(fn($e) => [
                'type' => 'expense',
                'title' => $e->category,
                'amount' => -$e->amount,
                'date' => $e->entry_date,
                'icon' => 'heroicon-o-minus-circle',
                'color' => 'text-red-500'
            ])))
            ->sortByDesc('date')
            ->take(5);

        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        $startOfLastWeek = now()->subWeek()->startOfWeek();
        $endOfLastWeek = now()->subWeek()->endOfWeek();

        $thisWeekIncome = \App\Models\Income::whereBetween('entry_date', [$startOfWeek, $endOfWeek])->sum('amount');
        $thisWeekExpense = \App\Models\Expense::whereBetween('entry_date', [$startOfWeek, $endOfWeek])->sum('amount');
        $thisWeekTotal = $thisWeekIncome + $thisWeekExpense;
        $thisWeekIncomePercent = $thisWeekTotal > 0 ? ($thisWeekIncome / $thisWeekTotal) * 100 : 0;
        $thisWeekExpensePercent = $thisWeekTotal > 0 ? ($thisWeekExpense / $thisWeekTotal) * 100 : 0;

        $lastWeekIncome = \App\Models\Income::whereBetween('entry_date', [$startOfLastWeek, $endOfLastWeek])->sum('amount');
        $lastWeekExpense = \App\Models\Expense::whereBetween('entry_date', [$startOfLastWeek, $endOfLastWeek])->sum('amount');
        $lastWeekTotal = $lastWeekIncome + $lastWeekExpense;
        $lastWeekIncomePercent = $lastWeekTotal > 0 ? ($lastWeekIncome / $lastWeekTotal) * 100 : 0;
        $lastWeekExpensePercent = $lastWeekTotal > 0 ? ($lastWeekExpense / $lastWeekTotal) * 100 : 0;

        $openTrade = \App\Models\OpenTrade::where('is_active', true)->latest()->first();
        $assets = \App\Models\Asset::all();

        if ($assets->isEmpty()) {
            $assets = collect([
                (object)['name' => 'Ekuitas', 'percentage' => 65, 'color' => 'bg-accent-500'],
                (object)['name' => 'Kripto', 'percentage' => 20, 'color' => 'bg-primary-400'],
                (object)['name' => 'Komoditas', 'percentage' => 15, 'color' => 'bg-red-400'],
            ]);
        }

        return view('livewire.trading-dashboard', [
            'balance' => $balance,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'recentTransactions' => $recentTransactions,
            'thisWeekIncome' => $thisWeekIncome,
            'thisWeekExpense' => $thisWeekExpense,
            'thisWeekIncomePercent' => $thisWeekIncomePercent,
            'thisWeekExpensePercent' => $thisWeekExpensePercent,
            'lastWeekIncome' => $lastWeekIncome,
            'lastWeekExpense' => $lastWeekExpense,
            'lastWeekIncomePercent' => $lastWeekIncomePercent,
            'lastWeekExpensePercent' => $lastWeekExpensePercent,
            'openTrade' => $openTrade,
            'assets' => $assets,
        ]);
    }
}

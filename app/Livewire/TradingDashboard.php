<?php

namespace App\Livewire;

use Livewire\Component;

class TradingDashboard extends Component
{
    public $filter = 'all';

    public $selectedTradeId;
    public $selectedTradeType;

    // Form properties
    public $showAddForm = false;
    public $amount;
    public $category;
    public $transactionType = 'income';

    public function toggleAddForm()
    {
        $this->showAddForm = !$this->showAddForm;
        if (!$this->showAddForm) {
            $this->reset(['amount', 'category', 'transactionType']);
        }
    }

    public function addTransaction()
    {
        $this->validate([
            'amount' => 'required|numeric|min:0.01',
            'category' => 'required|string|max:255',
            'transactionType' => 'required|in:income,expense',
        ]);

        if ($this->transactionType === 'income') {
            \App\Models\Income::create([
                'amount' => $this->amount,
                'category' => $this->category,
                'entry_date' => now(),
            ]);
        } else {
            \App\Models\Expense::create([
                'amount' => $this->amount,
                'category' => $this->category,
                'entry_date' => now(),
            ]);
        }

        $this->toggleAddForm();
        $this->dispatch('notify', 'Transaksi berhasil ditambahkan!');
    }

    public function selectTrade($id, $type)
    {
        $this->selectedTradeId = $id;
        $this->selectedTradeType = $type;
    }

    public function finishTrade()
    {
        $activeTrade = \App\Models\OpenTrade::where('is_active', true)->latest()->first();
        
        $pair = $activeTrade ? $activeTrade->pair : 'XAUUSD';
        $analysis = $activeTrade ? $activeTrade->analysis : 'Mock testing trade';

        // Log as income (profit)
        \App\Models\Income::create([
            'amount' => 240.50,
            'category' => $pair,
            'entry_date' => now(),
            'description' => 'Closed trade: ' . $pair . ' (' . $analysis . ')',
        ]);

        if ($activeTrade) {
            $activeTrade->update(['is_active' => false]);
        }
        
        $this->reset(['selectedTradeId', 'selectedTradeType']);
        $this->dispatch('notify', 'Trade selesai dan telah dicatat!');
    }

    public function selectRunningTrade()
    {
        $this->reset(['selectedTradeId', 'selectedTradeType']);
    }

    public function render()
    {
        $totalIncome = \App\Models\Income::sum('amount');
        $totalExpense = \App\Models\Expense::sum('amount');
        $balance = $totalIncome - $totalExpense;

        $recentTransactions = collect()
            ->when($this->filter === 'all' || $this->filter === 'profit', fn($c) => $c->concat(\App\Models\Income::latest()->take(10)->get()->map(fn($i) => [
                'id' => $i->id,
                'type' => 'income',
                'title' => $i->category,
                'amount' => $i->amount,
                'date' => $i->entry_date,
                'icon' => 'heroicon-o-plus-circle',
                'color' => 'text-accent-500'
            ])))
            ->when($this->filter === 'all' || $this->filter === 'loss', fn($c) => $c->concat(\App\Models\Expense::latest()->take(10)->get()->map(fn($e) => [
                'id' => $e->id,
                'type' => 'expense',
                'title' => $e->category,
                'amount' => -$e->amount,
                'date' => $e->entry_date,
                'icon' => 'heroicon-o-minus-circle',
                'color' => 'text-red-500'
            ])))
            ->sortByDesc('date')
            ->take(10);

        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        $startOfLastWeek = now()->subWeek()->startOfWeek();
        $endOfLastWeek = now()->subWeek()->endOfWeek();

        $thisWeekIncome = \App\Models\Income::whereBetween('entry_date', [$startOfWeek, $endOfWeek])->sum('amount');
        $thisWeekExpense = \App\Models\Expense::whereBetween('entry_date', [$startOfWeek, $endOfWeek])->sum('amount');
        $thisWeekTotal = $thisWeekIncome + $thisWeekExpense;
        $thisWeekIncomePercent = $thisWeekTotal > 0 ? ($thisWeekIncome / $thisWeekTotal) * 100 : 0;
        $thisWeekExpensePercent = $thisWeekTotal > 0 ? ($thisWeekExpense / $thisWeekTotal) * 100 : 0;

        $profitCount = \App\Models\Income::whereBetween('entry_date', [$startOfWeek, $endOfWeek])->count();
        $lossCount = \App\Models\Expense::whereBetween('entry_date', [$startOfWeek, $endOfWeek])->count();

        $lastWeekIncome = \App\Models\Income::whereBetween('entry_date', [$startOfLastWeek, $endOfLastWeek])->sum('amount');
        $lastWeekExpense = \App\Models\Expense::whereBetween('entry_date', [$startOfLastWeek, $endOfLastWeek])->sum('amount');
        $lastWeekTotal = $thisWeekIncome + $thisWeekExpense; // Note: Logic maintained as per previous file state
        $lastWeekIncomePercent = $lastWeekTotal > 0 ? ($lastWeekIncome / $lastWeekTotal) * 100 : 0;
        $lastWeekExpensePercent = $lastWeekTotal > 0 ? ($lastWeekExpense / $lastWeekTotal) * 100 : 0;

        // 1. Get the Live Running Trade (Constant display)
        $runningTrade = \App\Models\OpenTrade::where('is_active', true)->latest()->first();

        // 2. Get the Display/Selection Data (Dynamic Analysis section)
        $openTrade = null;
        if ($this->selectedTradeId && $this->selectedTradeType) {
            $tx = ($this->selectedTradeType === 'income') 
                ? \App\Models\Income::find($this->selectedTradeId) 
                : \App\Models\Expense::find($this->selectedTradeId);

            if ($tx) {
                $openTrade = (object)[
                    'pair' => $tx->category,
                    'timeframe' => 'HISTORICAL',
                    'analysis' => $tx->description ?? ($this->selectedTradeType === 'income' ? 'Profit transaction for ' . $tx->category : 'Expense transaction for ' . $tx->category),
                    'entry_price' => $tx->amount,
                    'target_price' => $tx->amount,
                    'stop_loss' => 0,
                    'image_path' => null,
                    'is_historical' => true,
                ];
            }
        }

        // Default to running trade if no historical selection
        if (!$openTrade) {
            $openTrade = $runningTrade;
        }

        // 3. Get Weekly Pair Distribution (Reset every Sunday)
        $startOfWeek = now()->startOfWeek();
        $weeklyIncomes = \App\Models\Income::where('created_at', '>=', $startOfWeek)->get();
        $weeklyExpenses = \App\Models\Expense::where('created_at', '>=', $startOfWeek)->get();
        
        $allWeeklyTrades = $weeklyIncomes->concat($weeklyExpenses);
        $totalWeeklyTrades = $allWeeklyTrades->count();

        $pairCounts = $allWeeklyTrades->groupBy('category')->map(fn($group) => $group->count());
        
        $colors = ['bg-accent-500', 'bg-primary-400', 'bg-red-400', 'bg-emerald-400', 'bg-purple-400', 'bg-orange-400', 'bg-pink-400'];
        $colorIndex = 0;

        $assets = $pairCounts->map(function($count, $pair) use ($totalWeeklyTrades, $colors, &$colorIndex) {
            $percentage = $totalWeeklyTrades > 0 ? round(($count / $totalWeeklyTrades) * 100) : 0;
            $color = $colors[$colorIndex % count($colors)];
            $colorIndex++;
            
            return (object)[
                'name' => $pair,
                'count' => $count,
                'percentage' => $percentage,
                'color' => $color
            ];
        })->values();

        if ($assets->isEmpty()) {
            $assets = collect([
                (object)['name' => 'XAUUSD', 'count' => 0, 'percentage' => 0, 'color' => 'bg-accent-500'],
                (object)['name' => 'EURUSD', 'count' => 0, 'percentage' => 0, 'color' => 'bg-primary-400'],
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
            'runningTrade' => $runningTrade,
            'assets' => $assets,
            'profitCount' => $profitCount,
            'lossCount' => $lossCount,
            'recentUsers' => \App\Models\User::latest()->take(3)->get(),
        ]);
    }

}

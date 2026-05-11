<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class TradingDashboard extends Component
{
    use WithFileUploads;

    public $filter = 'all';

    public $selectedTradeId;
    public $selectedTradeType;

    // Form properties
    public $showAddForm = false;
    // Enhanced Quick Transaction fields
    public $tradeImage;
    public $stopLoss;
    public $takeProfit;
    public $pairName;
    public $tradeReason;

    public $isEditing = false;
    public $editTakeProfit;
    public $editStopLoss;
    public $editAnalysis;

    public function toggleAddForm()
    {
        $this->showAddForm = !$this->showAddForm;
        if (!$this->showAddForm) {
            $this->reset(['tradeImage', 'stopLoss', 'takeProfit', 'pairName', 'tradeReason']);
            $this->resetValidation();
        }
    }

    public function addTransaction()
    {
        $this->validate([
            'tradeImage' => 'required|image|max:5120',
            'pairName' => 'required|string|max:255',
            'stopLoss' => 'required|numeric',
            'takeProfit' => 'required|numeric',
            'tradeReason' => 'required|string|min:5',
        ], [
            'tradeImage.required' => 'Upload gambar transaksi wajib diisi.',
            'tradeImage.image' => 'File harus berupa gambar.',
            'tradeImage.max' => 'Gambar maksimal 5MB.',
            'pairName.required' => 'Nama pair wajib diisi.',
            'stopLoss.required' => 'Nominal Loss wajib diisi.',
            'stopLoss.numeric' => 'Nominal Loss harus berupa angka.',
            'takeProfit.required' => 'Nominal Profit wajib diisi.',
            'takeProfit.numeric' => 'Nominal Profit harus berupa angka.',
            'tradeReason.required' => 'Alasan open trade wajib diisi.',
            'tradeReason.min' => 'Alasan open trade minimal 5 karakter.',
        ]);

        // Deactivate any existing active trade first
        \App\Models\OpenTrade::where('is_active', true)->update(['is_active' => false]);

        // Upload image
        $imagePath = $this->tradeImage->store('trades', 'public');

        // Create new OpenTrade (Running Trade)
        \App\Models\OpenTrade::create([
            'pair' => $this->pairName,
            'timeframe' => 'ACTIVE',
            'image_path' => $imagePath,
            'analysis' => $this->tradeReason,
            'entry_price' => 0, // Not used anymore
            'target_price' => $this->takeProfit, // This is the nominal profit
            'stop_loss' => $this->stopLoss, // This is the nominal loss
            'amount' => 0, // Not used anymore
            'is_active' => true,
        ]);

        $this->toggleAddForm();
        $this->dispatch('notify', 'Trade berhasil dibuat! Data masuk ke Running Trade.');
    }

    public function selectTrade($id, $type)
    {
        $this->selectedTradeId = $id;
        $this->selectedTradeType = $type;
        $this->isEditing = false;
    }

    public function finishTradeProfit()
    {
        $activeTrade = \App\Models\OpenTrade::where('is_active', true)->latest()->first();

        if (!$activeTrade) {
            $this->dispatch('notify', 'Tidak ada trade aktif untuk diselesaikan.');
            return;
        }

        // Record as Income (Profit) — balance increases
        \App\Models\Income::create([
            'amount' => $activeTrade->target_price, // target_price is used to store nominal profit
            'category' => $activeTrade->pair,
            'entry_date' => now(),
            'description' => 'Profit trade: ' . $activeTrade->pair . ' — ' . $activeTrade->analysis,
            'image_path' => $activeTrade->image_path,
        ]);

        $activeTrade->update(['is_active' => false]);
        $this->reset(['selectedTradeId', 'selectedTradeType']);
        $this->dispatch('notify', 'Trade PROFIT berhasil dicatat! Saldo bertambah.');
    }

    public function finishTradeLoss()
    {
        $activeTrade = \App\Models\OpenTrade::where('is_active', true)->latest()->first();

        if (!$activeTrade) {
            $this->dispatch('notify', 'Tidak ada trade aktif untuk diselesaikan.');
            return;
        }

        // Record as Expense (Loss) — balance decreases
        \App\Models\Expense::create([
            'amount' => $activeTrade->stop_loss, // stop_loss is used to store nominal loss
            'category' => $activeTrade->pair,
            'entry_date' => now(),
            'description' => 'Loss trade: ' . $activeTrade->pair . ' — ' . $activeTrade->analysis,
            'image_path' => $activeTrade->image_path,
        ]);

        $activeTrade->update(['is_active' => false]);
        $this->reset(['selectedTradeId', 'selectedTradeType']);
        $this->dispatch('notify', 'Trade LOSS berhasil dicatat! Saldo berkurang.');
    }

    public function selectRunningTrade()
    {
        $this->reset(['selectedTradeId', 'selectedTradeType', 'isEditing']);
    }

    public function editTrade()
    {
        if (session('auth_user_email') !== 'admin@admin.com') return;
        if (!$this->selectedTradeId || !$this->selectedTradeType) return;
        
        $tx = ($this->selectedTradeType === 'income') 
            ? \App\Models\Income::find($this->selectedTradeId) 
            : \App\Models\Expense::find($this->selectedTradeId);

        if ($tx) {
            $this->editTakeProfit = $this->selectedTradeType === 'income' ? $tx->amount : 0;
            $this->editStopLoss = $this->selectedTradeType === 'expense' ? $tx->amount : 0;
            $this->editAnalysis = $tx->description;
            $this->isEditing = true;
        }
    }

    public function saveTrade()
    {
        if (session('auth_user_email') !== 'admin@admin.com') return;
        if (!$this->selectedTradeId || !$this->selectedTradeType) return;

        $tx = ($this->selectedTradeType === 'income') 
            ? \App\Models\Income::find($this->selectedTradeId) 
            : \App\Models\Expense::find($this->selectedTradeId);

        if ($tx) {
            $takeProfitVal = (float) $this->editTakeProfit;
            $stopLossVal = (float) $this->editStopLoss;

            $isNowIncome = $takeProfitVal > 0;
            $isNowExpense = !$isNowIncome;
            
            if ($isNowIncome) {
                if ($this->selectedTradeType === 'income') {
                    $tx->update([
                        'amount' => $takeProfitVal,
                        'description' => $this->editAnalysis,
                    ]);
                } else {
                    $newTx = \App\Models\Income::create([
                        'amount' => $takeProfitVal,
                        'category' => $tx->category,
                        'entry_date' => $tx->entry_date,
                        'description' => $this->editAnalysis,
                        'image_path' => $tx->image_path,
                    ]);
                    $tx->delete();
                    $this->selectedTradeId = $newTx->id;
                    $this->selectedTradeType = 'income';
                }
            } else {
                if ($this->selectedTradeType === 'expense') {
                    $tx->update([
                        'amount' => $stopLossVal,
                        'description' => $this->editAnalysis,
                    ]);
                } else {
                    $newTx = \App\Models\Expense::create([
                        'amount' => $stopLossVal,
                        'category' => $tx->category,
                        'entry_date' => $tx->entry_date,
                        'description' => $this->editAnalysis,
                        'image_path' => $tx->image_path,
                    ]);
                    $tx->delete();
                    $this->selectedTradeId = $newTx->id;
                    $this->selectedTradeType = 'expense';
                }
            }

            $this->isEditing = false;
            $this->dispatch('notify', 'Transaksi berhasil diupdate!');
        }
    }

    public function cancelEdit()
    {
        $this->isEditing = false;
    }

    public function logout()
    {
        session()->forget(['authenticated', 'auth_user_id', 'auth_user_name']);
        return $this->redirect('/', navigate: false);
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
        $lastWeekTotal = $thisWeekIncome + $thisWeekExpense;
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
                    'target_price' => $this->selectedTradeType === 'income' ? $tx->amount : 0,
                    'stop_loss' => $this->selectedTradeType === 'expense' ? $tx->amount : 0,
                    'image_path' => $tx->image_path,
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

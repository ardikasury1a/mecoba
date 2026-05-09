<div class="min-h-screen bg-dashboard text-slate-300 p-6 md:p-10 font-sans selection:bg-accent-500/30 relative overflow-hidden">
    {{-- Notification --}}
    <div x-data="{ show: false, message: '' }" 
         x-on:notify.window="show = true; message = $event.detail; setTimeout(() => show = false, 3000)"
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-[-20px]"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform translate-y-[-20px]"
         class="fixed top-10 left-1/2 -translate-x-1/2 z-[100] px-6 py-3 bg-accent-500 text-dark-950 rounded-full font-bold text-xs uppercase tracking-widest shadow-2xl shadow-accent-500/40"
         style="display: none;">
        <span x-text="message"></span>
    </div>

    {{-- Header --}}
    <header class="flex justify-between items-center mb-12 px-2">
        <div>
            <h1 class="text-2xl font-black uppercase tracking-tighter text-white">Quantum <span class="text-accent-500">Trade</span></h1>
        </div>
        <div class="flex items-center gap-4">
            <button wire:click="toggleAddForm" class="px-6 py-2.5 bg-white/5 hover:bg-white/10 border border-white/5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all glass">
                {{ $showAddForm ? 'Close' : 'Management' }}
            </button>
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-accent-500 to-emerald-600 p-[2px]">
                <div class="w-full h-full rounded-[10px] bg-dark-900 overflow-hidden flex items-center justify-center">
                    <span class="text-[10px] font-black text-accent-500">AS</span>
                </div>
            </div>
        </div>
    </header>

    {{-- Quick Action Panel --}}
    <div x-data="{ open: @entangle('showAddForm') }" x-show="open" x-collapse>
        <div class="mb-12 p-8 rounded-[2rem] bg-white/5 border border-white/5 backdrop-blur-xl relative overflow-hidden glass">
            <h3 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-8">Quick Transaction</h3>
            <form wire:submit.prevent="addTransaction" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                <div class="space-y-3">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Type</label>
                    <div class="grid grid-cols-2 gap-2 p-1 bg-black/40 rounded-xl border border-white/5">
                        <button type="button" wire:click="$set('transactionType', 'income')" class="py-2 rounded-lg text-[9px] font-bold uppercase transition-all {{ $transactionType === 'income' ? 'bg-accent-500 text-dark-950' : 'text-slate-500' }}">Profit</button>
                        <button type="button" wire:click="$set('transactionType', 'expense')" class="py-2 rounded-lg text-[9px] font-bold uppercase transition-all {{ $transactionType === 'expense' ? 'bg-red-500 text-white' : 'text-slate-500' }}">Loss</button>
                    </div>
                </div>
                <div class="space-y-3">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Asset / Pair</label>
                    <input type="text" wire:model="category" placeholder="XAUUSD" class="w-full bg-black/40 border border-white/5 rounded-xl px-4 py-2.5 text-xs focus:border-accent-500 focus:ring-0 text-white">
                </div>
                <div class="space-y-3">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Amount</label>
                    <input type="number" wire:model="amount" placeholder="0.00" class="w-full bg-black/40 border border-white/5 rounded-xl px-4 py-2.5 text-xs focus:border-accent-500 focus:ring-0 text-white">
                </div>
                <button type="submit" class="w-full py-3 bg-white text-dark-950 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-accent-500 transition-all">Save</button>
            </form>
        </div>
    </div>

    {{-- Row 1: Unified Stats & Monitoring --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12">
        {{-- Left: Portfolio Balance & Weekly Summary (7/12) --}}
        <div class="lg:col-span-7 p-10 rounded-[2.5rem] bg-[#0a0d14]/80 border border-white/5 glass relative overflow-hidden flex flex-col justify-between min-h-[320px]">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-[9px] font-bold text-slate-500 uppercase tracking-[0.3em] mb-4">Total Saldo Portofolio</p>
                    <h2 class="text-7xl font-black text-white tracking-tighter leading-none">
                        ${{ number_format($balance, 2, '.', ',') }}
                    </h2>
                </div>
                <div class="text-right">
                    <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mb-4">Minggu Ini</p>
                    <p class="text-2xl font-black text-white tracking-tight uppercase">
                        {{ $profitCount + $lossCount }}x Trade
                    </p>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1">
                        <span class="text-red-500">{{ $lossCount }} Loss</span>, 
                        <span class="text-accent-500">{{ $profitCount }} Profit</span>
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-8 mt-12 pt-8 border-t border-white/5">
                <div>
                    <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mb-3">Pemasukan Bulanan</p>
                    <p class="text-3xl font-black text-accent-500 tracking-tight">+${{ number_format($totalIncome, 0, '.', ',') }}</p>
                </div>
                <div>
                    <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mb-3">Pengeluaran Bulanan</p>
                    <p class="text-3xl font-black text-red-500 tracking-tight">-${{ number_format($totalExpense, 0, '.', ',') }}</p>
                </div>
            </div>
        </div>

        {{-- Right: Side Monitor (5/12) --}}
        <div class="lg:col-span-5 space-y-8">
            {{-- Admin Activity --}}
            <div class="p-8 rounded-[2.5rem] bg-[#0a0d14]/80 border border-white/5 glass relative overflow-hidden">
                <h2 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 mb-6">Aktivitas Admin</h2>
                <div class="space-y-6">
                    @foreach($recentUsers as $user)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-accent-500/10 flex items-center justify-center border border-accent-500/20">
                                <span class="text-[12px] font-black text-accent-500 uppercase">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="text-[11px] font-black text-white uppercase tracking-tight">{{ $user->name }}</p>
                                <p class="text-[9px] font-bold text-slate-500 lowercase">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="flex items-center gap-1.5 justify-end">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span class="text-[8px] font-black text-emerald-500 uppercase tracking-widest">Active</span>
                            </div>
                            <p class="text-[8px] font-bold text-slate-600 uppercase mt-1">{{ $user->updated_at->format('H:i') }} WIB</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Running Trade --}}
            <div wire:click="selectRunningTrade" class="p-8 rounded-[2.5rem] bg-[#0a0d14]/80 border border-white/5 glass flex items-center gap-8 relative overflow-hidden cursor-pointer hover:bg-[#0a0d14]/90 transition-all group">
                <div class="absolute top-0 right-0 p-8">
                    <button wire:click.stop="finishTrade" class="px-4 py-2 bg-accent-500/10 border border-accent-500/20 rounded-xl text-[9px] font-black text-accent-500 uppercase tracking-widest hover:bg-accent-500 hover:text-dark-950 transition-all">
                        Finish Trade
                    </button>
                </div>
                <div class="relative w-20 h-20 flex items-center justify-center">
                    <div class="w-16 h-16 rounded-full border-4 border-accent-500/20 flex items-center justify-center">
                        <div class="w-10 h-10 rounded-full bg-accent-500/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-accent-500 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="text-[10px] font-black text-white uppercase tracking-widest mb-1">Running Trade</p>
                    <p class="text-[14px] font-black text-white tracking-tight uppercase">
                        {{ $runningTrade->pair ?? 'XAUUSD' }} <span class="text-accent-500 ml-1">• BUY</span>
                    </p>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-2">
                        P/L: <span class="text-accent-500">+$240.50</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 2: Assets & Recent Transactions --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12">
        {{-- Pair Distribution Circle --}}
        <div class="lg:col-span-4 p-8 rounded-[2.5rem] bg-dark-800/40 border border-white/5 glass">
            <h2 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 mb-8">Aktivitas Pair (Mingguan)</h2>
            <div class="relative w-48 h-48 mx-auto mb-8">
                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                    @php $offset = 0; @endphp
                    @foreach($assets as $asset)
                    <circle class="transition-all duration-1000" cx="50" cy="50" r="40" fill="transparent" stroke="currentColor" stroke-width="12" 
                        style="stroke-dasharray: {{ $asset->percentage }} 100; stroke-dashoffset: -{{ $offset }}; color: var(--{{ str_replace('bg-', '', $asset->color) }})" />
                    @php $offset += $asset->percentage; @endphp
                    @endforeach
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-[24px] font-black text-white leading-none">{{ $assets->sum('count') }}</span>
                    <span class="text-[8px] font-bold text-slate-500 uppercase tracking-widest mt-1">Total Trade</span>
                </div>
            </div>
            <div class="space-y-4">
                @foreach($assets as $asset)
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $asset->name }} ({{ $asset->count }})</span>
                        <span class="text-[9px] font-black text-white">{{ $asset->percentage }}%</span>
                    </div>
                    <div class="h-1 w-full bg-white/5 rounded-full overflow-hidden">
                        <div class="h-full {{ $asset->color }} rounded-full" style="width: {{ $asset->percentage }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
            <p class="text-[8px] font-bold text-slate-600 uppercase tracking-widest mt-12 leading-relaxed italic">
                * Data distribusi pair diakumulasi dari hasil transaksi dan direset setiap hari Minggu.
            </p>
        </div>

        {{-- Recent Transactions --}}
        <div class="lg:col-span-8 p-8 rounded-[2.5rem] bg-dark-800/40 border border-white/5 glass">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">Hasil Transaksi</h2>
                <div class="flex gap-3">
                    <button wire:click="$set('filter', 'all')" class="px-3 py-1 rounded-lg text-[8px] font-bold uppercase transition-all {{ $filter === 'all' ? 'bg-accent-500 text-dark-950' : 'bg-white/5 text-slate-400 hover:bg-white/10' }}">ALL</button>
                    <button wire:click="$set('filter', 'profit')" class="px-3 py-1 rounded-lg text-[8px] font-bold uppercase transition-all {{ $filter === 'profit' ? 'bg-accent-500 text-dark-950' : 'bg-white/5 text-slate-400 hover:bg-white/10' }}">PROFIT</button>
                    <button wire:click="$set('filter', 'loss')" class="px-3 py-1 rounded-lg text-[8px] font-bold uppercase transition-all {{ $filter === 'loss' ? 'bg-accent-500 text-dark-950' : 'bg-white/5 text-slate-400 hover:bg-white/10' }}">LOSS</button>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($recentTransactions->take(4) as $tx)
                <div wire:click="selectTrade({{ $tx['id'] }}, '{{ $tx['type'] }}')" class="p-5 rounded-2xl bg-white/5 border border-white/5 flex items-center gap-4 hover:bg-white/10 transition-all cursor-pointer">
                    <div class="w-10 h-10 rounded-xl bg-black/40 flex items-center justify-center glass">
                        <x-filament::icon :icon="$tx['icon']" class="w-5 h-5 {{ $tx['color'] }}" />
                    </div>
                    <div class="flex-1">
                        <div class="text-xs font-black text-white">{{ $tx['title'] }}</div>
                        <div class="text-[8px] font-bold text-slate-600 uppercase">{{ \Carbon\Carbon::parse($tx['date'])->format('d M, Y') }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs font-black {{ $tx['color'] }}">{{ $tx['amount'] > 0 ? '+' : '' }}{{ number_format($tx['amount'] / 16000, 2) }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Row 3: Analysis & Mapping --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {{-- Mapping --}}
        <div class="lg:col-span-8 aspect-[16/9] lg:aspect-auto lg:h-[450px] relative rounded-[2.5rem] overflow-hidden border border-white/5 glass">
            @if($openTrade && $openTrade->image_path)
                <img src="{{ asset('storage/' . $openTrade->image_path) }}" class="w-full h-full object-cover opacity-80" alt="Mapping">
            @else
                <div class="w-full h-full flex flex-col items-center justify-center gap-4 text-slate-700 bg-black/20">
                    <svg class="w-16 h-16 opacity-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002-2z"/></svg>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] opacity-30">Waiting for Signal...</span>
                </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-dark-950/90 via-transparent to-transparent"></div>
            <div class="absolute bottom-8 left-8 flex gap-3">
                <span class="px-4 py-2 {{ isset($openTrade->is_historical) ? 'bg-primary-500' : 'bg-accent-500' }} text-dark-950 text-[9px] font-black uppercase rounded-full">
                    {{ isset($openTrade->is_historical) ? 'HISTORICAL' : 'ACTIVE' }}
                </span>
                <span class="px-4 py-2 bg-white/10 text-white text-[9px] font-black uppercase rounded-full backdrop-blur-md">
                    {{ $openTrade->timeframe ?? 'M15' }}
                </span>
            </div>
        </div>

        {{-- Analysis --}}
        <div class="lg:col-span-4 flex flex-col gap-6">
            <div class="p-8 rounded-[2.5rem] bg-dark-800/40 border border-white/5 glass flex-1">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-8 rounded-lg bg-accent-500/10 flex items-center justify-center text-accent-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h2 class="text-[10px] font-black uppercase tracking-widest text-white">
                        {{ isset($openTrade->is_historical) ? 'Detail Transaksi' : 'Analisa Open Trade' }}
                    </h2>
                </div>
                <p class="text-xs text-slate-400 leading-relaxed font-medium">
                    {{ $openTrade->analysis ?? 'Belum ada analisa aktif. Sistem sedang memindai peluang di market berdasarkan kriteria setup high-probability.' }}
                </p>
            </div>

            <div class="p-8 rounded-[2.5rem] bg-dark-800/40 border border-white/5 glass">
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 bg-white/5 rounded-xl border border-white/5">
                        <span class="text-[9px] font-bold text-slate-500 uppercase">Entry</span>
                        <span class="text-xs font-black text-white">{{ $openTrade ? number_format($openTrade->entry_price, 2) : '0.00' }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-accent-500/10 rounded-xl border border-accent-500/20">
                        <span class="text-[9px] font-bold text-accent-500 uppercase">Target</span>
                        <span class="text-xs font-black text-accent-500">{{ $openTrade ? number_format($openTrade->target_price, 2) : '0.00' }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-red-500/10 rounded-xl border border-red-500/20">
                        <span class="text-[9px] font-bold text-red-500 uppercase">Stop Loss</span>
                        <span class="text-xs font-black text-red-500">{{ $openTrade ? number_format($openTrade->stop_loss, 2) : '0.00' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-dashboard {
            background: radial-gradient(circle at top right, #0f172a, #05070a);
        }
        .glass {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</div>
      .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.02);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #00e699;
        }
    </style>
</div>

<div class="min-h-screen bg-dashboard text-white pb-24">
    {{-- Header --}}
    <header class="flex items-center justify-between px-6 py-6 sticky top-0 z-50 glass-strong">
        <div class="flex items-center gap-3">
            <button class="p-2 hover:bg-white/5 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <h1 class="text-xl font-heading font-extrabold tracking-tighter uppercase">Quantum <span class="text-accent-500">Trade</span></h1>
        </div>
        <div class="w-10 h-10 rounded-full border-2 border-accent-500 overflow-hidden shadow-lg shadow-accent-500/20">
            <img src="https://ui-avatars.com/api/?name=Ardika+Surya&background=00e699&color=fff" alt="Profil">
        </div>
    </header>

    <div class="px-6 py-8 w-full max-w-[1600px] mx-auto">
        {{-- Title --}}
        <div class="space-y-2 mb-10 text-center lg:text-left">
            <h2 class="text-4xl font-heading font-bold tracking-tight">Ringkasan Keuangan</h2>
            <p class="text-slate-400 font-medium">Pemantauan real-time aset likuid global dan pergerakan modal Anda.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- Balance & Stats --}}
            <div class="lg:col-span-8 space-y-8">
                {{-- Balance Card --}}
                <div class="relative overflow-hidden rounded-3xl p-8 bg-[#121721] border border-white/5 shadow-2xl h-full flex flex-col justify-center">
                    <div class="absolute top-0 right-0 -mr-8 -mt-8 w-64 h-64 bg-accent-500/10 rounded-full blur-3xl text-accent-500"></div>
                    
                    <div class="space-y-10 relative z-10">
                        <div class="space-y-2">
                            <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Total Saldo Portofolio</span>
                            <div class="text-7xl font-heading font-extrabold tracking-tighter">
                                ${{ number_format($balance, 2) }}
                            </div>
                        </div>

                        <div class="flex items-center gap-16">
                            <div class="space-y-1">
                                <div class="flex items-center gap-1 text-xs font-bold uppercase tracking-widest text-slate-400">
                                    <svg class="w-3 h-3 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                    Pemasukan Bulanan
                                </div>
                                <div class="text-4xl font-heading font-bold text-white">
                                    +${{ number_format($totalIncome, 0) }}
                                </div>
                            </div>
                            <div class="space-y-1">
                                <div class="flex items-center gap-1 text-xs font-bold uppercase tracking-widest text-slate-400">
                                    <svg class="w-3 h-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                                    Pengeluaran Bulanan
                                </div>
                                <div class="text-4xl font-heading font-bold text-white">
                                    -${{ number_format($totalExpense, 0) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4">
                {{-- Weekly Circular Stats --}}
                <div class="flex flex-col gap-6 p-8 rounded-3xl bg-white/5 border border-white/5 h-full justify-center">
                    {{-- This Week --}}
                    <div class="flex items-center gap-6">
                        <div class="relative w-28 h-28 flex-shrink-0">
                            <svg class="w-full h-full -rotate-90" viewBox="0 0 36 36">
                                <circle cx="18" cy="18" r="16" fill="none" class="stroke-white/10" stroke-width="3"></circle>
                                <circle cx="18" cy="18" r="16" fill="none" class="stroke-accent-500" stroke-width="3" stroke-dasharray="{{ $thisWeekIncomePercent }}, 100" stroke-linecap="round"></circle>
                                <circle cx="18" cy="18" r="16" fill="none" class="stroke-red-500" stroke-width="3" stroke-dasharray="{{ $thisWeekExpensePercent }}, 100" stroke-dashoffset="-{{ $thisWeekIncomePercent }}" stroke-linecap="round"></circle>
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-lg font-heading font-extrabold text-white">{{ round($thisWeekIncomePercent) }}%</span>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="text-xs font-bold uppercase tracking-widest text-white">Minggu Ini</div>
                            <div class="text-xs font-bold text-accent-500">Masuk: +${{ number_format($thisWeekIncome, 0) }}</div>
                            <div class="text-xs font-bold text-red-500">Keluar: -${{ number_format($thisWeekExpense, 0) }}</div>
                        </div>
                    </div>

                    <div class="h-px bg-white/5 w-full"></div>

                    {{-- Last Week --}}
                    <div class="flex items-center gap-6">
                        <div class="relative w-28 h-28 flex-shrink-0">
                            <svg class="w-full h-full -rotate-90" viewBox="0 0 36 36">
                                <circle cx="18" cy="18" r="16" fill="none" class="stroke-white/10" stroke-width="3"></circle>
                                <circle cx="18" cy="18" r="16" fill="none" class="stroke-accent-500 opacity-50" stroke-width="3" stroke-dasharray="{{ $lastWeekIncomePercent }}, 100" stroke-linecap="round"></circle>
                                <circle cx="18" cy="18" r="16" fill="none" class="stroke-red-500 opacity-50" stroke-width="3" stroke-dasharray="{{ $lastWeekExpensePercent }}, 100" stroke-dashoffset="-{{ $lastWeekIncomePercent }}" stroke-linecap="round"></circle>
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-lg font-heading font-extrabold text-slate-500">{{ round($lastWeekIncomePercent) }}%</span>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="text-xs font-bold uppercase tracking-widest text-slate-500">Minggu Lalu</div>
                            <div class="text-xs font-bold text-slate-500">Masuk: +${{ number_format($lastWeekIncome, 0) }}</div>
                            <div class="text-xs font-bold text-slate-500">Keluar: -${{ number_format($lastWeekExpense, 0) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Row 2: Asset Allocation (Smaller) & Open Trade (Larger) --}}
            {{-- Row 2: Asset Allocation & Hasil Transaksi --}}
            <div class="lg:col-span-12 grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                {{-- Asset Allocation --}}
                <div class="lg:col-span-4 p-8 rounded-3xl bg-[#121721] border border-white/5 space-y-8 flex flex-col justify-between shadow-2xl">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-slate-500">Alokasi Aset</h3>
                            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                        </div>
                        <div class="space-y-8">
                            @foreach($assets as $asset)
                            <div class="space-y-3">
                                <div class="flex justify-between text-sm font-bold">
                                    <span class="text-slate-300">{{ $asset->name }}</span>
                                    <span class="text-accent-500">{{ $asset->percentage }}%</span>
                                </div>
                                <div class="h-2 w-full bg-white/5 rounded-full overflow-hidden">
                                    <div class="h-full {{ $asset->color ?? 'bg-accent-500' }} shadow-[0_0_10px_rgba(0,230,153,0.3)]" style="width: {{ $asset->percentage }}%"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="pt-6 border-t border-white/5">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest leading-loose">
                            Distribusi modal optimal berdasarkan toleransi risiko dan target pertumbuhan kuartal ini.
                        </p>
                    </div>
                </div>

                {{-- Hasil Transaksi Section --}}
                <div class="lg:col-span-8 p-8 rounded-3xl bg-[#121721] border border-white/5 shadow-2xl space-y-6 flex flex-col h-[480px]">
                    <div class="flex items-center justify-between px-2">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-500">Hasil Transaksi</h3>
                        <div class="flex gap-2">
                            <button wire:click="$set('filter', 'all')" class="px-3 py-1.5 text-[10px] font-bold uppercase tracking-widest rounded-lg transition {{ $filter === 'all' ? 'bg-white/20 text-white' : 'bg-white/5 text-slate-500 hover:text-white' }}">All</button>
                            <button wire:click="$set('filter', 'profit')" class="px-3 py-1.5 text-[10px] font-bold uppercase tracking-widest rounded-lg transition {{ $filter === 'profit' ? 'bg-accent-500 text-dark-950' : 'bg-white/10 text-slate-400 hover:bg-white/20' }}">Profit</button>
                            <button wire:click="$set('filter', 'loss')" class="px-3 py-1.5 text-[10px] font-bold uppercase tracking-widest rounded-lg transition {{ $filter === 'loss' ? 'bg-red-500 text-white' : 'bg-white/10 text-slate-400 hover:bg-white/20' }}">Loss</button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 flex-1 content-start overflow-y-auto pr-2" style="scrollbar-width: thin; scrollbar-color: rgba(255,255,255,0.1) transparent;">
                        @foreach($recentTransactions as $tx)
                        <div class="flex items-center justify-between p-4 rounded-2xl bg-white/5 border border-white/5 hover:bg-white/10 transition-colors group">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-slate-300 group-hover:scale-110 transition-transform">
                                    <x-filament::icon :icon="$tx['icon']" class="w-5 h-5" />
                                </div>
                                <div>
                                    <div class="font-bold text-white text-xs">{{ $tx['title'] }}</div>
                                    <div class="text-[9px] font-bold text-slate-500 uppercase tracking-tight mt-0.5">{{ \Carbon\Carbon::parse($tx['date'])->format('d M, Y') }}</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-heading font-bold {{ $tx['color'] }}">{{ $tx['amount'] > 0 ? '+' : '' }}${{ number_format($tx['amount'], 0) }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Row 3: Open Trade Section 1 --}}
            <div class="lg:col-span-12 grid grid-cols-1 md:grid-cols-12 gap-8">
                {{-- Mapping Image --}}
                <div class="md:col-span-7 relative rounded-3xl overflow-hidden border border-white/10 group shadow-2xl bg-slate-900 flex items-center justify-center min-h-[400px]">
                    @if($openTrade && $openTrade->image_path)
                        <img src="{{ asset('storage/' . $openTrade->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" alt="Trade Mapping">
                    @else
                        <img src="/trade_mapping_chart_1777620609019.png" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000 opacity-50" alt="Trade Mapping Placeholder">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-widest bg-dark-950/50 px-4 py-2 rounded-full border border-white/5 backdrop-blur-md">Menunggu Mapping...</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-dark-900/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6 flex items-center gap-3">
                        <span class="px-4 py-1.5 bg-accent-500 text-dark-950 text-[10px] font-bold uppercase tracking-widest rounded-full shadow-lg shadow-accent-500/20">
                            {{ $openTrade->pair ?? 'Pair' }}
                        </span>
                        <span class="px-4 py-1.5 bg-white/10 backdrop-blur-md text-white text-[10px] font-bold uppercase tracking-widest rounded-full border border-white/10">
                            {{ $openTrade->timeframe ?? 'TF' }}
                        </span>
                    </div>
                </div>

                {{-- 3-Part Analysis --}}
                <div class="md:col-span-5 flex flex-col gap-6">
                    {{-- Part 1: Header --}}
                    <div class="p-6 rounded-3xl bg-[#121721] border border-white/5 shadow-xl">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-accent-500/10 flex items-center justify-center text-accent-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            </div>
                            <h4 class="text-xs font-bold uppercase tracking-widest text-accent-500">Analisa Open Trade</h4>
                        </div>
                    </div>

                    {{-- Part 2: Detailed Analysis --}}
                    <div class="p-6 rounded-3xl bg-[#121721] border border-white/5 shadow-xl flex-1">
                        <div class="space-y-4">
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Narasi Analisa</span>
                            <p class="text-[13px] text-slate-300 leading-relaxed font-medium">
                                {{ $openTrade->analysis ?? 'Belum ada analisa trade yang aktif saat ini. Menunggu konfirmasi setup teknikal sesuai rule trading plan.' }}
                            </p>
                        </div>
                    </div>

                    {{-- Part 3: Execution Stats --}}
                    <div class="p-6 rounded-3xl bg-[#121721] border border-white/5 shadow-xl">
                        <div class="space-y-4">
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Parameter Eksekusi</span>
                            <div class="grid grid-cols-1 gap-3">
                                <div class="flex justify-between items-center p-3 rounded-xl bg-white/5 border border-white/5">
                                    <span class="text-[11px] font-bold text-slate-500 uppercase">Entry</span>
                                    <span class="text-sm font-heading font-bold text-white">{{ $openTrade ? number_format($openTrade->entry_price, 2) : '0.00' }}</span>
                                </div>
                                <div class="flex justify-between items-center p-3 rounded-xl bg-accent-500/5 border border-accent-500/10">
                                    <span class="text-[11px] font-bold text-accent-500 uppercase">Target</span>
                                    <span class="text-sm font-heading font-bold text-accent-500">{{ $openTrade ? number_format($openTrade->target_price, 2) : '0.00' }}</span>
                                </div>
                                <div class="flex justify-between items-center p-3 rounded-xl bg-red-500/5 border border-red-500/10">
                                    <span class="text-[11px] font-bold text-red-500 uppercase">Risk (SL)</span>
                                    <span class="text-sm font-heading font-bold text-red-500">{{ $openTrade ? number_format($openTrade->stop_loss, 2) : '0.00' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Row 4: Open Trade Section 2 --}}
            <div class="lg:col-span-12 grid grid-cols-1 md:grid-cols-12 gap-8 pt-8 border-t border-white/5 mt-4">
                {{-- Mapping Image --}}
                <div class="md:col-span-7 relative rounded-3xl overflow-hidden border border-white/10 group shadow-2xl bg-slate-900 flex items-center justify-center min-h-[400px]">
                    @if($openTrade && $openTrade->image_path)
                        <img src="{{ asset('storage/' . $openTrade->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" alt="Trade Mapping">
                    @else
                        <img src="/trade_mapping_chart_1777620609019.png" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000 opacity-50" alt="Trade Mapping Placeholder">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-widest bg-dark-950/50 px-4 py-2 rounded-full border border-white/5 backdrop-blur-md">Menunggu Mapping...</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-dark-900/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6 flex items-center gap-3">
                        <span class="px-4 py-1.5 bg-accent-500 text-dark-950 text-[10px] font-bold uppercase tracking-widest rounded-full shadow-lg shadow-accent-500/20">
                            {{ $openTrade->pair ?? 'Pair' }}
                        </span>
                        <span class="px-4 py-1.5 bg-white/10 backdrop-blur-md text-white text-[10px] font-bold uppercase tracking-widest rounded-full border border-white/10">
                            {{ $openTrade->timeframe ?? 'TF' }}
                        </span>
                    </div>
                </div>

                {{-- 3-Part Analysis --}}
                <div class="md:col-span-5 flex flex-col gap-6">
                    {{-- Part 1: Header --}}
                    <div class="p-6 rounded-3xl bg-[#121721] border border-white/5 shadow-xl">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-accent-500/10 flex items-center justify-center text-accent-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            </div>
                            <h4 class="text-xs font-bold uppercase tracking-widest text-accent-500">Analisa Open Trade (Secondary)</h4>
                        </div>
                    </div>

                    {{-- Part 2: Detailed Analysis --}}
                    <div class="p-6 rounded-3xl bg-[#121721] border border-white/5 shadow-xl flex-1">
                        <div class="space-y-4">
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Narasi Analisa</span>
                            <p class="text-[13px] text-slate-300 leading-relaxed font-medium">
                                {{ $openTrade->analysis ?? 'Belum ada analisa trade yang aktif saat ini. Menunggu konfirmasi setup teknikal sesuai rule trading plan.' }}
                            </p>
                        </div>
                    </div>

                    {{-- Part 3: Execution Stats --}}
                    <div class="p-6 rounded-3xl bg-[#121721] border border-white/5 shadow-xl">
                        <div class="space-y-4">
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Parameter Eksekusi</span>
                            <div class="grid grid-cols-1 gap-3">
                                <div class="flex justify-between items-center p-3 rounded-xl bg-white/5 border border-white/5">
                                    <span class="text-[11px] font-bold text-slate-500 uppercase">Entry</span>
                                    <span class="text-sm font-heading font-bold text-white">{{ $openTrade ? number_format($openTrade->entry_price, 2) : '0.00' }}</span>
                                </div>
                                <div class="flex justify-between items-center p-3 rounded-xl bg-accent-500/5 border border-accent-500/10">
                                    <span class="text-[11px] font-bold text-accent-500 uppercase">Target</span>
                                    <span class="text-sm font-heading font-bold text-accent-500">{{ $openTrade ? number_format($openTrade->target_price, 2) : '0.00' }}</span>
                                </div>
                                <div class="flex justify-between items-center p-3 rounded-xl bg-red-500/5 border border-red-500/10">
                                    <span class="text-[11px] font-bold text-red-500 uppercase">Risk (SL)</span>
                                    <span class="text-sm font-heading font-bold text-red-500">{{ $openTrade ? number_format($openTrade->stop_loss, 2) : '0.00' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom Navigation --}}
    <div class="fixed bottom-0 left-0 right-0 z-50 px-4 pb-4">
        <div class="max-w-md mx-auto glass-strong rounded-3xl p-2 flex items-center justify-around shadow-2xl border border-white/10">
            <button class="flex flex-col items-center gap-1 p-2 text-slate-400 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                <span class="text-[10px] font-bold uppercase tracking-widest">Dasbor</span>
            </button>
            <button class="flex flex-col items-center gap-1 p-2 text-accent-500 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                <span class="text-[10px] font-bold uppercase tracking-widest">Buku Besar</span>
            </button>
            <div class="relative -mt-12">
                <a href="/admin" class="w-14 h-14 bg-accent-500 rounded-2xl flex items-center justify-center text-dark-950 shadow-lg shadow-accent-500/50 hover:scale-110 transition-all">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </a>
            </div>
            <button class="flex flex-col items-center gap-1 p-2 text-slate-400 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="text-[10px] font-bold uppercase tracking-widest">Riwayat</span>
            </button>
            <button class="flex flex-col items-center gap-1 p-2 text-slate-400 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span class="text-[10px] font-bold uppercase tracking-widest">Akun</span>
            </button>
        </div>
    </div>
</div>

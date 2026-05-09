<x-filament-widgets::widget>
    <x-filament::section>
        <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: space-between;">
            {{-- Pemasukan --}}
            <a href="{{ \App\Filament\Resources\Incomes\IncomeResource::getUrl('create') }}" 
               style="flex: 1; min-width: 140px; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.5rem; border-radius: 1.5rem; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); transition: all 0.3s ease; text-decoration: none;"
               onmouseover="this.style.background='rgba(16, 185, 129, 0.2)'" 
               onmouseout="this.style.background='rgba(16, 185, 129, 0.1)'">
                <div style="width: 3.5rem; height: 3.5rem; display: flex; align-items: center; justify-content: center; background: #10b981; border-radius: 1rem; box-shadow: 0 0 15px rgba(16, 185, 129, 0.4); margin-bottom: 0.75rem;">
                    <x-filament::icon icon="heroicon-o-plus-circle" style="width: 2rem; height: 2rem; color: white;" />
                </div>
                <span style="font-size: 11px; font-weight: 900; color: #10b981; text-transform: uppercase; letter-spacing: -0.025em; text-align: center; line-height: 1.2;">Tambah<br>Pemasukan</span>
            </a>

            {{-- Pengeluaran --}}
            <a href="{{ \App\Filament\Resources\Expenses\ExpenseResource::getUrl('create') }}" 
               style="flex: 1; min-width: 140px; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.5rem; border-radius: 1.5rem; background: rgba(244, 63, 94, 0.1); border: 1px solid rgba(244, 63, 94, 0.2); transition: all 0.3s ease; text-decoration: none;"
               onmouseover="this.style.background='rgba(244, 63, 94, 0.2)'" 
               onmouseout="this.style.background='rgba(244, 63, 94, 0.1)'">
                <div style="width: 3.5rem; height: 3.5rem; display: flex; align-items: center; justify-content: center; background: #f43f5e; border-radius: 1rem; box-shadow: 0 0 15px rgba(244, 63, 94, 0.4); margin-bottom: 0.75rem;">
                    <x-filament::icon icon="heroicon-o-minus-circle" style="width: 2rem; height: 2rem; color: white;" />
                </div>
                <span style="font-size: 11px; font-weight: 900; color: #f43f5e; text-transform: uppercase; letter-spacing: -0.025em; text-align: center; line-height: 1.2;">Tambah<br>Pengeluaran</span>
            </a>

            {{-- Running Trade --}}
            <a href="{{ \App\Filament\Resources\OpenTrades\OpenTradeResource::getUrl('index') }}" 
               style="flex: 1; min-width: 140px; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.5rem; border-radius: 1.5rem; background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.2); transition: all 0.3s ease; text-decoration: none;"
               onmouseover="this.style.background='rgba(245, 158, 11, 0.2)'" 
               onmouseout="this.style.background='rgba(245, 158, 11, 0.1)'">
                <div style="width: 3.5rem; height: 3.5rem; display: flex; align-items: center; justify-content: center; background: #f59e0b; border-radius: 1rem; box-shadow: 0 0 15px rgba(245, 158, 11, 0.4); margin-bottom: 0.75rem;">
                    <x-filament::icon icon="heroicon-o-bolt" style="width: 2rem; height: 2rem; color: white;" />
                </div>
                <span style="font-size: 11px; font-weight: 900; color: #f59e0b; text-transform: uppercase; letter-spacing: -0.025em; text-align: center; line-height: 1.2;">Running<br>Trade</span>
            </a>

            {{-- History Trade --}}
            <a href="{{ \App\Filament\Resources\OpenTrades\OpenTradeResource::getUrl('index') }}" 
               style="flex: 1; min-width: 140px; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.5rem; border-radius: 1.5rem; background: rgba(99, 102, 241, 0.1); border: 1px solid rgba(99, 102, 241, 0.2); transition: all 0.3s ease; text-decoration: none;"
               onmouseover="this.style.background='rgba(99, 102, 241, 0.2)'" 
               onmouseout="this.style.background='rgba(99, 102, 241, 0.1)'">
                <div style="width: 3.5rem; height: 3.5rem; display: flex; align-items: center; justify-content: center; background: #6366f1; border-radius: 1rem; box-shadow: 0 0 15px rgba(99, 102, 241, 0.4); margin-bottom: 0.75rem;">
                    <x-filament::icon icon="heroicon-o-clock" style="width: 2rem; height: 2rem; color: white;" />
                </div>
                <span style="font-size: 11px; font-weight: 900; color: #818cf8; text-transform: uppercase; letter-spacing: -0.025em; text-align: center; line-height: 1.2;">History<br>Trade</span>
            </a>

            {{-- Total Saldo --}}
            <a href="{{ \App\Filament\Resources\Assets\AssetResource::getUrl('index') }}" 
               style="flex: 1; min-width: 140px; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.5rem; border-radius: 1.5rem; background: rgba(14, 165, 233, 0.1); border: 1px solid rgba(14, 165, 233, 0.2); transition: all 0.3s ease; text-decoration: none;"
               onmouseover="this.style.background='rgba(14, 165, 233, 0.2)'" 
               onmouseout="this.style.background='rgba(14, 165, 233, 0.1)'">
                <div style="width: 3.5rem; height: 3.5rem; display: flex; align-items: center; justify-content: center; background: #0ea5e9; border-radius: 1rem; box-shadow: 0 0 15px rgba(14, 165, 233, 0.4); margin-bottom: 0.75rem;">
                    <x-filament::icon icon="heroicon-o-banknotes" style="width: 2rem; height: 2rem; color: white;" />
                </div>
                <span style="font-size: 11px; font-weight: 900; color: #38bdf8; text-transform: uppercase; letter-spacing: -0.025em; text-align: center; line-height: 1.2;">Total<br>Saldo</span>
            </a>

            {{-- Analisa Dashboard --}}
            <a href="/" target="_blank" 
               style="flex: 1; min-width: 140px; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.5rem; border-radius: 1.5rem; background: rgba(71, 85, 105, 0.1); border: 1px solid rgba(71, 85, 105, 0.2); transition: all 0.3s ease; text-decoration: none;"
               onmouseover="this.style.background='rgba(71, 85, 105, 0.2)'" 
               onmouseout="this.style.background='rgba(71, 85, 105, 0.1)'">
                <div style="width: 3.5rem; height: 3.5rem; display: flex; align-items: center; justify-content: center; background: #334155; border-radius: 1rem; box-shadow: 0 0 15px rgba(51, 65, 85, 0.4); margin-bottom: 0.75rem;">
                    <x-filament::icon icon="heroicon-o-presentation-chart-line" style="width: 2rem; height: 2rem; color: white;" />
                </div>
                <span style="font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: -0.025em; text-align: center; line-height: 1.2;">Analisa<br>Dashboard</span>
            </a>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

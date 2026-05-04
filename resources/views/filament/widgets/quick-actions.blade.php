<x-filament-widgets::widget>
    <x-filament::section>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ \App\Filament\Resources\Incomes\IncomeResource::getUrl('create') }}" class="flex items-center justify-center gap-3 p-6 bg-green-600 hover:bg-green-500 text-white rounded-xl transition-all shadow-lg hover:shadow-green-500/20 group">
                <x-filament::icon icon="heroicon-o-plus-circle" class="w-8 h-8 group-hover:scale-110 transition-transform" />
                <div class="text-left">
                    <span class="block text-sm opacity-80 uppercase tracking-wider font-bold">Trading</span>
                    <span class="text-xl font-extrabold italic">TAMBAH PEMASUKAN</span>
                </div>
            </a>

            <a href="{{ \App\Filament\Resources\Expenses\ExpenseResource::getUrl('create') }}" class="flex items-center justify-center gap-3 p-6 bg-red-600 hover:bg-red-500 text-white rounded-xl transition-all shadow-lg hover:shadow-red-500/20 group">
                <x-filament::icon icon="heroicon-o-minus-circle" class="w-8 h-8 group-hover:scale-110 transition-transform" />
                <div class="text-left">
                    <span class="block text-sm opacity-80 uppercase tracking-wider font-bold">Trading</span>
                    <span class="text-xl font-extrabold italic">TAMBAH PENGELUARAN</span>
                </div>
            </a>

            <a href="{{ \App\Filament\Resources\Incomes\IncomeResource::getUrl('index') }}" class="flex items-center justify-center gap-3 p-6 bg-sky-600 hover:bg-sky-500 text-white rounded-xl transition-all shadow-lg hover:shadow-sky-500/20 group">
                <x-filament::icon icon="heroicon-o-document-chart-bar" class="w-8 h-8 group-hover:scale-110 transition-transform" />
                <div class="text-left">
                    <span class="block text-sm opacity-80 uppercase tracking-wider font-bold">Laporan</span>
                    <span class="text-xl font-extrabold italic">LIHAT TRANSAKSI</span>
                </div>
            </a>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

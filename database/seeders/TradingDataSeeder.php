<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Income;
use App\Models\Expense;

class TradingDataSeeder extends Seeder
{
    public function run(): void
    {
        Income::create([
            'amount' => 4250.00,
            'category' => 'Tesla Inc. Dividend',
            'entry_date' => now()->subDays(1),
            'description' => 'Quarterly dividend payout',
        ]);

        Income::create([
            'amount' => 12840.40,
            'category' => 'FX Arbitrage Profit',
            'entry_date' => now()->subDays(2),
            'description' => 'Successful arbitrage trade',
        ]);

        Expense::create([
            'amount' => 890.12,
            'category' => 'AWS Server Infrastructure',
            'entry_date' => now()->subDays(1)->subHours(2),
            'description' => 'Monthly server hosting',
        ]);

        Expense::create([
            'amount' => 1240.00,
            'category' => 'Quarterly Tax Payment',
            'entry_date' => now()->subDays(2)->subHours(5),
            'description' => 'Income tax estimation',
        ]);
    }
}

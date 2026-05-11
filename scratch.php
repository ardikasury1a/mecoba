<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Incomes:\n";
print_r(\App\Models\Income::latest()->take(5)->get()->toArray());

echo "\nExpenses:\n";
print_r(\App\Models\Expense::latest()->take(5)->get()->toArray());

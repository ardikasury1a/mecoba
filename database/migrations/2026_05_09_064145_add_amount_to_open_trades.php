<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('open_trades', function (Blueprint $table) {
            $table->decimal('amount', 15, 2)->default(0)->after('stop_loss');
        });
    }

    public function down(): void
    {
        Schema::table('open_trades', function (Blueprint $table) {
            $table->dropColumn('amount');
        });
    }
};

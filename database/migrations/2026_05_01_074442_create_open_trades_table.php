<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('open_trades', function (Blueprint $table) {
            $table->id();
            $table->string('pair');
            $table->string('timeframe');
            $table->string('image_path')->nullable();
            $table->text('analysis');
            $table->decimal('entry_price', 15, 2);
            $table->decimal('target_price', 15, 2);
            $table->decimal('stop_loss', 15, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('open_trades');
    }
};

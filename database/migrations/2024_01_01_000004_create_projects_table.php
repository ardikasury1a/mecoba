<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->json('tech_stack')->nullable();
            $table->string('live_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('category')->default('Web');
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            // Multi-language
            $table->string('title_en')->nullable();
            $table->text('description_en')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

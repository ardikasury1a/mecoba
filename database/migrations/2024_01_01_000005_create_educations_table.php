<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('institution');
            $table->string('degree');
            $table->string('field_of_study')->nullable();
            $table->integer('start_year');
            $table->integer('end_year')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            // Multi-language
            $table->string('degree_en')->nullable();
            $table->string('field_of_study_en')->nullable();
            $table->text('description_en')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};

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
        Schema::create('research_statistics', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->integer('count');
            $table->string('category')->nullable(); // Kategori tambahan jika diperlukan
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_statistics');
    }
};

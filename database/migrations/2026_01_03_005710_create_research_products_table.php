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
        Schema::create('research_products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('researcher'); // Nama peneliti
            $table->year('year');
            $table->enum('type', ['penelitian', 'pengabdian']); // Jenis penelitian atau pengabdian
            $table->string('image')->nullable();
            $table->string('file')->nullable(); // File produk penelitian
            $table->string('link')->nullable(); // Link eksternal
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_products');
    }
};

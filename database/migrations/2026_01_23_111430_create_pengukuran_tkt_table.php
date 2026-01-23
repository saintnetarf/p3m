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
        Schema::create('pengukuran_tkt', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('file'); // Path ke file PDF
            $table->string('file_name')->nullable(); // Nama file asli
            $table->string('file_type')->nullable(); // Tipe file
            $table->integer('file_size')->nullable(); // Ukuran file dalam bytes
            $table->string('kategori')->nullable(); // Kategori TKT
            $table->integer('level_tkt')->nullable(); // Level TKT 1-9
            $table->integer('download_count')->default(0);
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengukuran_tkt');
    }
};

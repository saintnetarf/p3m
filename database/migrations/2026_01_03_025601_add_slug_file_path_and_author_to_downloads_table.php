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
        Schema::table('downloads', function (Blueprint $table) {
            $table->string('slug')->unique()->after('title');
            $table->string('file_path')->nullable()->after('file');
            $table->string('file_name')->nullable()->after('file_path');
            $table->foreignId('author_id')->nullable()->after('download_count')->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('downloads', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn(['slug', 'file_path', 'file_name', 'author_id']);
        });
    }
};

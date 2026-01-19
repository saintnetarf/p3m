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
        Schema::table('research_products', function (Blueprint $table) {
            $table->string('category')->nullable()->after('year');
            $table->foreignId('author_id')->nullable()->after('link')->constrained('users')->onDelete('set null');
            $table->boolean('is_featured')->default(false)->after('author_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('research_products', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn(['category', 'author_id', 'is_featured']);
        });
    }
};

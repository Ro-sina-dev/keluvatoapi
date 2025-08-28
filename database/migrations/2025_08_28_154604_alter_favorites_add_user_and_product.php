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
    Schema::table('favorites', function (Blueprint $table) {
        if (!Schema::hasColumn('favorites', 'user_id')) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        }
        if (!Schema::hasColumn('favorites', 'product_id')) {
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
        }
    });
}

public function down(): void
{
    Schema::table('favorites', function (Blueprint $table) {
        $table->dropConstrainedForeignId('user_id');
        $table->dropConstrainedForeignId('product_id');
    });
}

};

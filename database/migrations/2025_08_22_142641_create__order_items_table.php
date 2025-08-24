<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->restrictOnDelete();

            $table->string('name');          // snapshot du nom (au moment de l’achat)
            $table->decimal('price',10,2);   // snapshot du prix
            $table->unsignedInteger('quantity')->default(1);
            $table->json('meta')->nullable(); // variantes, options, etc.

            $table->timestamps();
            $table->index(['order_id','product_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('order_items');
    }
};


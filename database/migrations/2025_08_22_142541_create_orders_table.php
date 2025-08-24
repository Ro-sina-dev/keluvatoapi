<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('status')->default('pending'); // pending, paid, shipped, completed, canceled
            $table->string('currency', 10)->default('EUR');

            // totaux (calculés au moment de la commande)
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('shipping', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);

            // adresses “figées” à la commande (pas d’obligation pour démarrer)
            $table->json('shipping_address')->nullable();
            $table->json('billing_address')->nullable();

            $table->timestamps();
            $table->index(['user_id','status']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('orders');
    }
};


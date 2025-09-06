<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('number')->unique()->after('id');
            $table->string('payment_provider')->nullable()->after('status'); // 'stripe'
            $table->string('stripe_session_id')->nullable()->unique()->after('payment_provider');
            $table->string('stripe_payment_intent')->nullable()->unique()->after('stripe_session_id');
            $table->timestamp('paid_at')->nullable()->after('updated_at');
        });
    }
    public function down(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['number','payment_provider','stripe_session_id','stripe_payment_intent','paid_at']);
        });
    }
};

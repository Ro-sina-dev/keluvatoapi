<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void
{
Schema::table('products', function (Blueprint $table) {
$table->unsignedInteger('likes_count')->default(0)->after('images');
$table->unsignedBigInteger('views_count')->default(0)->after('likes_count');
$table->decimal('discount_price', 10, 2)->nullable()->after('price');
$table->boolean('is_featured')->default(false)->after('is_active');
});
}


public function down(): void
{
Schema::table('products', function (Blueprint $table) {
$table->dropColumn(['likes_count','views_count','discount_price','is_featured']);
});
}
};

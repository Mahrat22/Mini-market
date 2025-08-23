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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');                // product name
        $table->string('sku')->unique();       // unique product code
        $table->text('description')->nullable();
        $table->decimal('price', 10, 2);       // price with 2 decimals
        $table->unsignedInteger('stock')->default(0);
        $table->string('category')->nullable(); // for filtering
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

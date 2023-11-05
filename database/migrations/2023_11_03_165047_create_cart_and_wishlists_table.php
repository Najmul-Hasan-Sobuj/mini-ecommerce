<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_and_wishlists', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['cart', 'wishlist']);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity')->nullable()->default(0);  // Nullable if not applicable to wishlist items
            $table->unsignedDecimal('price', 8, 2)->nullable(); // Nullable if not applicable to wishlist items
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_and_wishlists');
    }
};

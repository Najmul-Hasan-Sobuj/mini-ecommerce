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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('shipping_address_id')->constrained('shipping_and_billing_addresses')->cascadeOnDelete();
            $table->foreignId('billing_address_id')->constrained('shipping_and_billing_addresses')->cascadeOnDelete();
            $table->foreignId('payment_method_id')->constrained('payment_methods')->cascadeOnDelete();
            $table->timestamp('order_date')->useCurrent();
            $table->timestamp('shipped_date')->nullable();
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'return'])->default('pending');
            $table->unsignedDecimal('subtotal', 8, 2)->default(0.00);
            $table->unsignedDecimal('tax', 8, 2)->default(0.00);
            $table->unsignedDecimal('shipping_cost', 8, 2)->default(0.00);
            $table->unsignedDecimal('total_price', 8, 2)->default(0.00);
            $table->date('return_date')->nullable();
            $table->text('return_reason')->nullable();
            $table->double('return_amount', 10, 2)->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('orders');
    }
};

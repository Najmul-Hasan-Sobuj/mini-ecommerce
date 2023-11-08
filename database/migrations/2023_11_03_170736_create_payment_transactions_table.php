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
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();  // Reference to Orders table, cascade deletes
            $table->foreignId('payment_method_id')->constrained('payment_methods')->cascadeOnDelete();  // Reference to PaymentMethods table, cascade deletes
            $table->unsignedDecimal('amount', 8, 2);  // Transaction amount
            $table->string('transaction_id')->unique();  // Unique transaction identifier
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded']);  // Transaction status
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
        Schema::dropIfExists('payment_transactions');
    }
};

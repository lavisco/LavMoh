<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('code');
            $table->string('status', 50);
            $table->decimal('total_amount', 14, 2);
            $table->decimal('bank_charge', 14, 2);
            $table->decimal('platform_charge', 14, 2);
            $table->decimal('shop_discount', 14, 2)->nullable()->default('0.00');
            $table->decimal('payable_amount', 14, 2);
            
            $table->string('cleared_by')->nullable();
            $table->string('payment_mode', 50)->nullable();
            $table->date('clearance_date')->nullable();
            $table->date('request_withdrawal_date')->nullable();

            $table->foreignId('order_id')->constrained();
            $table->foreignId('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}

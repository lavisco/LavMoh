<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
			$table->string('status');
			$table->string('payment_method');
            $table->string('cms');
            $table->string('process_currency');

            $table->string('first_name');
            $table->string('last_name');
			$table->string('email');
            $table->string('contact_number', 20);
			$table->string('address_line_one');
			$table->string('address_line_two')->nullable();
			$table->string('postal_code', 12)->nullable();
			$table->string('city', 100);
			$table->string('district', 100)->nullable();
			$table->string('state', 100)->nullable();
            $table->string('country', 80);
			
			$table->decimal('total', 14, 2);
			$table->decimal('subtotal', 14, 2);
			$table->decimal('tax', 14, 2);
			$table->decimal('giftwrap_price', 14, 2)->nullable();
			$table->decimal('shipping_price', 14, 2);
			$table->decimal('discount_price', 14, 2)->nullable();
			
			$table->foreignId('order_id')->constrained();
			$table->foreignId('shop_id')->constrained();
			$table->foreignId('seller_id')->references('id')->on('users');
            $table->foreignId('buyer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipts');
    }
}

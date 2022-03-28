<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->timestamps();
            $table->string('code')->unique()->nullable();
            $table->string('name');
			$table->string('email');
            $table->string('phone', 20);
			$table->string('country', 80);
			$table->string('address');
			$table->string('zipcode', 12)->nullable();
			$table->string('city', 100);
			$table->string('district', 100)->nullable();
			$table->string('province', 100)->nullable();
            
            $table->string('status');
            $table->decimal('total', 14, 2);
			$table->decimal('subtotal', 14, 2);
			$table->decimal('tax', 14, 2);
			$table->decimal('giftwrap_price', 14, 2)->nullable()->default('0.00');
			$table->decimal('shipping_price', 14, 2);
			$table->decimal('discount_price', 14, 2)->nullable()->default('0.00');
			$table->foreignId('shop_id')->constrained();
			$table->foreignId('shipping_id')->constrained();
			$table->foreignId('discount_id')->nullable()->constrained();
			$table->foreignId('giftwrap_id')->nullable()->constrained();
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
        Schema::dropIfExists('orders');
    }
}

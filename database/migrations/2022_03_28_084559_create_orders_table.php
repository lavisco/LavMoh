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
            $table->string('first_name');
            $table->string('last_name');
			$table->string('email');
            $table->string('phone', 20);
			
			$table->string('address_line_one');
			$table->string('address_line_two')->nullable();
			$table->string('zipcode', 12)->nullable();
			$table->string('city', 100);
			$table->string('district', 100)->nullable();
			$table->string('state', 100)->nullable();
            $table->string('country', 80);

            $table->string('recipient_first_name');
            $table->string('recipient_last_name');
			$table->string('recipient_email')->nullable();
            $table->string('recipient_phone', 20);
            
			$table->string('billing_address_line_one');
			$table->string('billing_address_line_two')->nullable();
			$table->string('billing_zipcode', 12)->nullable();
			$table->string('billing_city', 100);
			$table->string('billing_district', 100)->nullable();
			$table->string('billing_state', 100)->nullable();
            $table->string('billing_country', 80);

            $table->date('delivery_date');
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

            $table->foreignId('order_state_id')->constrained();
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

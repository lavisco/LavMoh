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
            $table->boolean('was_paid');
			$table->boolean('was_claimed');
			$table->string('status');
			$table->string('name');
			$table->string('country', 80);
			$table->string('address', 255);
			$table->string('apt_no', 20)->nullable();
			$table->string('zipcode', 12)->nullable();
			$table->string('city', 100);
			$table->string('state', 100)->nullable();
			$table->string('payment_method');
			$table->string('payment_email');
			$table->boolean('has_giftwrap');
			
			$table->decimal('total', 14, 2);
			$table->decimal('subtotal', 14, 2);
			$table->decimal('tax', 14, 2);
			$table->decimal('giftwrap_price', 14, 2);
			$table->decimal('shipping_price', 14, 2);
			$table->decimal('discount_price', 14, 2)->nullable();
			
			$table->foreignId('cart_id')->constrained()->onDelete('cascade');
			$table->foreignId('shop_id')->constrained()->onDelete('cascade');
			$table->unsignedBigInteger('seller_id');
			$table->unsignedBigInteger('buyer_id');
            $table
                ->foreign('seller_id')
                ->references('id')
                ->on('users');
			$table
                ->foreign('buyer_id')
                ->references('id')
                ->on('users');
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

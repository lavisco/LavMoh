<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('total', 14, 2);
			$table->decimal('subtotal', 14, 2);
			$table->decimal('tax', 14, 2);
			$table->decimal('giftwrap_price', 14, 2);
			$table->decimal('shipping_price', 14, 2);
			$table->decimal('discount_price', 14, 2)->nullable();
			$table->string('discount_code')->nullable();
			$table->foreignId('shop_id')->constrained();
			$table->foreignId('user_id')->constrained();
			$table->foreignId('shipping_id')->constrained();
			$table->foreignId('order_id')->constrained();
			$table->foreignId('giftwrap_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}

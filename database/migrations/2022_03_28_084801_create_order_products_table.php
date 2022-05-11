<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('base_price', 14, 2);
			$table->integer('quantity');
			$table->decimal('total', 14, 2);
			$table->string('custom_text')->nullable();
			$table->string('custom_image')->nullable();
			$table->boolean('has_variations');
			$table->foreignId('order_id')->constrained();
			$table->foreignId('product_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}

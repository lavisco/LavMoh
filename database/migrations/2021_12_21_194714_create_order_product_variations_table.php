<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product_variations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('price', 14, 2);
			$table->foreignId('product_variation_id')->constrained();
            $table->foreignId('order_product_id')->references('id')->on('order_product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product_variations');
    }
}

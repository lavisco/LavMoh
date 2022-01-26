<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartProductVariationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_product_variations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('price', 14, 2);
			$table->integer('quantity');
			$table->decimal('total', 14, 2);
			$table->foreignId('product_variation_id')->constrained();
            $table->foreignId('cart_product_id')->references('id')->on('cart_product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_product_variation');
    }
}

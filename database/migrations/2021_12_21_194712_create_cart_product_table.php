<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_product', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('base_price', 14, 2);
			$table->integer('quantity');
			$table->decimal('total', 14, 2);
			$table->string('custom_text')->nullable();
			$table->string('custom_image')->nullable();
			$table->boolean('has_variations');
			$table->foreignId('cart_id')->constrained()->onDelete('cascade');
			$table->foreignId('product_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_product');
    }
}

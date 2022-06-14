<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductGiftboxVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product_giftbox_variations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('price', 14, 2);
            $table->integer('quantity');
            $table->foreignId('product_id')->constrained();
            $table->foreignId('order_product_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product_giftbox_variations');
    }
}

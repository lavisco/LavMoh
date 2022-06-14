<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftboxProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giftbox_products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('giftbox_id')->references('id')->on('products');
            $table->foreignId('product_id')->constrained();
            $table->integer('quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('giftbox_products');
    }
}

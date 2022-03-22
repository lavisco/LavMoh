<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariationOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variation_options', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 100);
            $table->string('sku', 16)->nullable();
            $table->decimal('price', 14, 2)->default('0.00')->nullable();
			$table->integer('quantity')->nullable();
            $table->foreignId('variation_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('product_state_id')->constrained();
            $table->foreignId('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variation_options');
    }
}

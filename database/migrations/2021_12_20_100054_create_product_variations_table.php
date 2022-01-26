<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('sku', 16)->unique()->nullable();
			$table->string('description', 500)->nullable();
			$table->decimal('price', 14, 2)->default('0.00')->nullable();
			$table->integer('quantity')->nullable();
            $table->string('type', 500);
            $table->string('type_option', 500);
            $table->foreignId('product_state_id')->constrained();
			$table->foreignId('product_id')->constrained();
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
        Schema::dropIfExists('product_variations');
    }
}

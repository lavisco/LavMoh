<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('sku', 16)->nullable();
            $table->string('code', 100)->unique()->nullable();
			$table->string('title', 255);
            $table->string('short_description', 500);
			$table->string('description', 2000);
			$table->string('material')->nullable();
            $table->string('slug');
			$table->decimal('length', 14, 2)->nullable();
			$table->decimal('width', 14, 2)->nullable();
			$table->decimal('height', 14, 2)->nullable();
			$table->string('dimensions_unit', 5)->nullable();
			$table->decimal('weight', 14, 2)->nullable();
			$table->string('weight_unit', 5)->nullable();
			$table->decimal('base_price', 14, 2)->default('0.00');
			$table->string('processing_time', 20)->nullable();
			$table->boolean('has_custom_text')->default(false);
			$table->boolean('has_custom_image')->default(false);
			$table->boolean('has_variations')->default(false);
            $table->boolean('has_giftwrap')->default(false);
			$table->boolean('has_inventory');
			$table->integer('quantity');
            $table->integer('rating')->nullable();
            $table->foreignId('product_state_id')->constrained();
			$table->foreignId('category_id')->constrained();
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
        Schema::dropIfExists('products');
    }
}

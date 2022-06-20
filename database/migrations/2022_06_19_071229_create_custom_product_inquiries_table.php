<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomProductInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_product_inquiries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('first_name');
            $table->string('last_name');
			$table->string('email');
            $table->string('phone', 20);
			$table->string('address');
			$table->string('zipcode', 12)->nullable();
			$table->string('city', 100);
			$table->string('district', 100)->nullable();
			$table->string('state', 100)->nullable();
            $table->string('country', 80);
            $table->string('description', 1000);
			$table->string('short_description')->nullable();
            $table->date('delivery_date');
            $table->string('image_path')->nullable();
            $table->string('status', 50);
            $table->foreignId('product_id')->constrained();
            $table->foreignId('user_id')->constrained(); //seller
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_product_inquiries');
    }
}

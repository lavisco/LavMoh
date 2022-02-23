<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 400);
            $table->string('slug')->nullable();
            $table->string('banner')->nullable();
			$table->string('url')->nullable();
			$table->string('about', 500);
			$table->integer('rating')->nullable();
            $table->string('country', 80);
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('city');
            $table->string('area')->nullable();
			$table->string('address', 500);
			$table->string('zipcode', 12)->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('shops');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyerProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_profiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('first_name', 100);
			$table->string('last_name', 100);
			$table->string('phone', 20);
            $table->string('email');
			$table->string('country', 80);
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('city');
			$table->string('address');
			$table->string('zipcode', 12)->nullable();
			$table->string('billing_address')->nullable();
            $table->foreignId('user_id')->constrained()->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buyer_profiles');
    }
}

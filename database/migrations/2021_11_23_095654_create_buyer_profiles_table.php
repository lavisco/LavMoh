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
			$table->string('country', 80);
			$table->string('address', 255);
			$table->string('apt_no', 20)->nullable();
			$table->string('zipcode', 12)->nullable();
			$table->string('city', 100);
			$table->string('state', 100)->nullable();
			$table->string('billing_country', 80);
			$table->string('billing_address', 255);
			$table->string('billing_apt_no', 20)->nullable();
			$table->string('billing_zipcode', 12)->nullable();
			$table->string('billing_city', 100);
			$table->string('billing_state', 100)->nullable();
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

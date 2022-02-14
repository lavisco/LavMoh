<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_profiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('first_name', 255);
			$table->string('last_name', 255);
			$table->string('phone', 20);
            $table->string('email');
			$table->string('country', 80);
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('city');
			$table->string('address');
			$table->string('zipcode', 12)->nullable();
			$table->string('billing_address')->nullable();
			$table->string('deposit_account', 34);
			$table->string('deposit_name');
			$table->string('deposit_bank');
			$table->string('deposit_bank_branch');
			$table->boolean('deposit_account_status');
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
        Schema::dropIfExists('seller_profiles');
    }
}

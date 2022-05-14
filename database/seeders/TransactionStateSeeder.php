<?php

namespace Database\Seeders;

use App\Models\TransactionState;
use Illuminate\Database\Seeder;

class TransactionStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionState::create(['id' => '1', 'state' => 'customer cleared payment']);
        TransactionState::create(['id' => '2', 'state' => 'bank processing payment']);
        TransactionState::create(['id' => '3', 'state' => 'bank cleared payment']);
        TransactionState::create(['id' => '4', 'state' => 'lavisco processing payment']);
        TransactionState::create(['id' => '5', 'state' => 'lavisco cleared payment']);
        TransactionState::create(['id' => '6', 'state' => 'payment Successfully deposited']);
    }
}

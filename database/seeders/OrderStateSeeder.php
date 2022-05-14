<?php

namespace Database\Seeders;

use App\Models\OrderState;
use Illuminate\Database\Seeder;

class OrderStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderState::create(['id' => '1', 'state' => 'not acknowledged']);
        OrderState::create(['id' => '2', 'state' => 'acknowledged']);
        OrderState::create(['id' => '3', 'state' => 'in production']);
        OrderState::create(['id' => '4', 'state' => 'ready for delivery']);
        OrderState::create(['id' => '5', 'state' => 'order dispatched']);
        OrderState::create(['id' => '6', 'state' => 'delivery in progress']);
        OrderState::create(['id' => '7', 'state' => 'delivery completed']);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Shipping;
use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shipping::create(['id' => '1', 'type' => 'Lavisco delivery','price' => '0.00','delivery_time' => '24 hours']);
    }
}

<?php

namespace Database\Seeders;

use App\Models\ProductState;
use Illuminate\Database\Seeder;

class ProductStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductState::create(['id' => '1', 'state' => 'active']);
        ProductState::create(['id' => '2', 'state' => 'inactive']);
        ProductState::create(['id' => '3', 'state' => 'removed']);
        ProductState::create(['id' => '4', 'state' => 'suspended']);
        ProductState::create(['id' => '5', 'state' => 'flagged']);
    }
}

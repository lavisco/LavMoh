<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'id' => '1', 
            'name' => 'Sri Lankan Rupee', 
            'code' => 'LKR', 
            'symbol' => 'Rs', 
            'exchange_rate' => 1.00, 
            'status' => 1
        ]);
        Currency::create([
            'id' => '2', 
            'name' => 'Australian Dollar', 
            'code' => 'AUD', 
            'symbol' => 'A$', 
            'exchange_rate' => 0.003900, 
            'status' => 1
        ]);
        Currency::create([
            'id' => '3', 
            'name' => 'United States Dollar', 
            'code' => 'USD', 
            'symbol' => '$', 
            'exchange_rate' => 0.002800, 
            'status' => 1
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Cake','status' => 1]);
        Category::create(['name' => 'Flower','status' => 1]);
        Category::create(['name' => 'Umbrella','status' => 1]);
        Category::create(['name' => 'Mug','status' => 1]);
        Category::create(['name' => 'Jewellery','status' => 1]);
    }
}

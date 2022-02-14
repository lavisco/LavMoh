<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Cake', 'status' => 1, 'slug' => Str::slug('Cake')]);
        Category::create(['name' => 'Flower','status' => 1, 'slug' => Str::slug('Flower')]);
        Category::create(['name' => 'Umbrella','status' => 1, 'slug' => Str::slug('Umbrella')]);
        Category::create(['name' => 'Mug','status' => 1, 'slug' => Str::slug('Mug')]);
        Category::create(['name' => 'Jewellery','status' => 1, 'slug' => Str::slug('Jewellery')]);
    }
}

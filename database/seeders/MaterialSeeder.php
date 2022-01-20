<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Material::create(['name' => 'Leather','status' => 1]);
        Material::create(['name' => 'Plastic','status' => 1]);
        Material::create(['name' => 'Wood','status' => 1]);
        Material::create(['name' => 'Plywood','status' => 1]);
        Material::create(['name' => 'Mixed','status' => 1]);
        Material::create(['name' => 'Fabric','status' => 1]);
        Material::create(['name' => 'Wool','status' => 1]);
        Material::create(['name' => 'Resin','status' => 1]);
        Material::create(['name' => 'Cotton','status' => 1]);
        Material::create(['name' => 'Silk','status' => 1]);
        Material::create(['name' => 'Wax','status' => 1]);
        Material::create(['name' => 'Ceramic','status' => 1]);
        Material::create(['name' => 'Copper','status' => 1]);
        Material::create(['name' => 'Stainless Steel','status' => 1]);
        Material::create(['name' => 'Aluminium','status' => 1]);
        Material::create(['name' => 'Brass','status' => 1]);
        Material::create(['name' => 'Iron','status' => 1]);
    }
}

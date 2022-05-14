<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            OccasionSeeder::class, 
            RecipientSeeder::class,
            CategorySeeder::class,
            ProductStateSeeder::class,
            ShippingSeeder::class,
            OrderStateSeeder::class,
            TransactionStateSeeder::class,
        ]);
    }
}

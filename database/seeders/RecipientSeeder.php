<?php

namespace Database\Seeders;

use App\Models\Recipient;
use Illuminate\Database\Seeder;

class RecipientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recipient::create(['id' => '1','name' => 'Self','status' => 1]);
        Recipient::create(['id' => '2','name' => 'Father','status' => 1]);
        Recipient::create(['id' => '3','name' => 'Mother','status' => 1]);
        Recipient::create(['id' => '4','name' => 'Husband','status' => 1]);
        Recipient::create(['id' => '5','name' => 'Wife','status' => 1]);
        Recipient::create(['id' => '6','name' => 'Lover','status' => 1]);
        Recipient::create(['id' => '7','name' => 'Girlfriend','status' => 1]);
        Recipient::create(['id' => '8','name' => 'Boyfriend','status' => 1]);
        Recipient::create(['id' => '9','name' => 'Friend','status' => 1]);
        Recipient::create(['id' => '10','name' => 'Sibling','status' => 1]);
        Recipient::create(['id' => '11','name' => 'Sister','status' => 1]);
        Recipient::create(['id' => '12','name' => 'Brother','status' => 1]);
        Recipient::create(['id' => '13','name' => 'Children','status' => 1]);
        Recipient::create(['id' => '14','name' => 'Son','status' => 1]);
        Recipient::create(['id' => '15','name' => 'Daughter','status' => 1]);
        Recipient::create(['id' => '16','name' => 'Grandparents','status' => 1]);
        Recipient::create(['id' => '17','name' => 'Grandmother','status' => 1]);
        Recipient::create(['id' => '18','name' => 'Grandfather','status' => 1]);
        Recipient::create(['id' => '19','name' => 'BestFriend','status' => 1]);
    }
}

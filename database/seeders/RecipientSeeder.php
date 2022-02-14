<?php

namespace Database\Seeders;

use App\Models\Recipient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RecipientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recipient::create(['id' => '1', 'slug' => Str::slug('Self'),'name' => 'Self','status' => 1]);
        Recipient::create(['id' => '2', 'slug' => Str::slug('Father'),'name' => 'Father','status' => 1]);
        Recipient::create(['id' => '3', 'slug' => Str::slug('Mother'),'name' => 'Mother','status' => 1]);
        Recipient::create(['id' => '4', 'slug' => Str::slug('Husband'),'name' => 'Husband','status' => 1]);
        Recipient::create(['id' => '5', 'slug' => Str::slug('Wife'),'name' => 'Wife','status' => 1]);
        Recipient::create(['id' => '6', 'slug' => Str::slug('Lover'),'name' => 'Lover','status' => 1]);
        Recipient::create(['id' => '7', 'slug' => Str::slug('Girlfriend'),'name' => 'Girlfriend','status' => 1]);
        Recipient::create(['id' => '8', 'slug' => Str::slug('Boyfriend'),'name' => 'Boyfriend','status' => 1]);
        Recipient::create(['id' => '9', 'slug' => Str::slug('Friend'),'name' => 'Friend','status' => 1]);
        Recipient::create(['id' => '10', 'slug' => Str::slug('Sibling'),'name' => 'Sibling','status' => 1]);
        Recipient::create(['id' => '11', 'slug' => Str::slug('Sister'),'name' => 'Sister','status' => 1]);
        Recipient::create(['id' => '12', 'slug' => Str::slug('Brother'),'name' => 'Brother','status' => 1]);
        Recipient::create(['id' => '13', 'slug' => Str::slug('Children'),'name' => 'Children','status' => 1]);
        Recipient::create(['id' => '14', 'slug' => Str::slug('Son'),'name' => 'Son','status' => 1]);
        Recipient::create(['id' => '15', 'slug' => Str::slug('Daughter'),'name' => 'Daughter','status' => 1]);
        Recipient::create(['id' => '16', 'slug' => Str::slug('Grandparents'),'name' => 'Grandparents','status' => 1]);
        Recipient::create(['id' => '17', 'slug' => Str::slug('Grandmother'),'name' => 'Grandmother','status' => 1]);
        Recipient::create(['id' => '18', 'slug' => Str::slug('Grandfather'),'name' => 'Grandfather','status' => 1]);
        Recipient::create(['id' => '19', 'slug' => Str::slug('BestFriend'),'name' => 'BestFriend','status' => 1]);
    }
}

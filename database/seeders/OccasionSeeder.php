<?php

namespace Database\Seeders;

use App\Models\Occasion;
use Illuminate\Database\Seeder;

class OccasionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Occasion::create(['id' => '1','name' => 'Birthday','status' => 1]);
        Occasion::create(['id' => '2','name' => 'New Year','status' => 1]);
        Occasion::create(['id' => '3','name' => 'Valentines Day','status' => 1]);
        Occasion::create(['id' => '4','name' => 'Fathers Day','status' => 1]);
        Occasion::create(['id' => '5','name' => 'Mothers Day','status' => 1]);
        Occasion::create(['id' => '6','name' => 'Christmas','status' => 1]);
        Occasion::create(['id' => '7','name' => 'Easter','status' => 1]);
        Occasion::create(['id' => '8','name' => 'Halloween','status' => 1]);
        Occasion::create(['id' => '9','name' => 'Thanksgiving','status' => 1]);
        Occasion::create(['id' => '10','name' => 'Ramadan','status' => 1]);
        Occasion::create(['id' => '11','name' => 'Eid-ul-fitr','status' => 1]);
        Occasion::create(['id' => '12','name' => 'Eid-ul-adha','status' => 1]);
        Occasion::create(['id' => '13','name' => 'Independence Day','status' => 1]);
        Occasion::create(['id' => '14','name' => 'Magha Puja','status' => 1]);
        Occasion::create(['id' => '15','name' => 'Mahashivaratri','status' => 1]);
        Occasion::create(['id' => '16','name' => 'Duruthu Perahera','status' => 1]);
        Occasion::create(['name' => 'Thai Pongal','status' => 1]);
        Occasion::create(['name' => 'Navam Perahera','status' => 1]);
        Occasion::create(['name' => 'Maha Sivarathri','status' => 1]);
        Occasion::create(['name' => 'Sinhala & Tamil New Year','status' => 1]);
        Occasion::create(['name' => 'Vesak Poya','status' => 1]);
        Occasion::create(['name' => 'Poson Festival','status' => 1]);
        Occasion::create(['name' => 'Kandy Esala Poya Perahera','status' => 1]);
        Occasion::create(['name' => 'Diwali','status' => 1]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Occasion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OccasionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Occasion::create(['id' => '1', 'slug' => Str::slug('Birthday'),'name' => 'Birthday','status' => 1]);
        Occasion::create(['id' => '2', 'slug' => Str::slug('New Year'),'name' => 'New Year','status' => 1]);
        Occasion::create(['id' => '3', 'slug' => Str::slug('Valentines Day'),'name' => 'Valentines Day','status' => 1]);
        Occasion::create(['id' => '4', 'slug' => Str::slug('Fathers Day'),'name' => 'Fathers Day','status' => 1]);
        Occasion::create(['id' => '5', 'slug' => Str::slug('Mothers Day'),'name' => 'Mothers Day','status' => 1]);
        Occasion::create(['id' => '6', 'slug' => Str::slug('Christmas'),'name' => 'Christmas','status' => 1]);
        Occasion::create(['id' => '7', 'slug' => Str::slug('Easter'),'name' => 'Easter','status' => 1]);
        Occasion::create(['id' => '8', 'slug' => Str::slug('Halloween'),'name' => 'Halloween','status' => 1]);
        Occasion::create(['id' => '9', 'slug' => Str::slug('Thanksgiving'),'name' => 'Thanksgiving','status' => 1]);
        Occasion::create(['id' => '10', 'slug' => Str::slug('Ramadan'),'name' => 'Ramadan','status' => 1]);
        Occasion::create(['id' => '11', 'slug' => Str::slug('Eid-ul-fitr'),'name' => 'Eid-ul-fitr','status' => 1]);
        Occasion::create(['id' => '12', 'slug' => Str::slug('Eid-ul-adha'),'name' => 'Eid-ul-adha','status' => 1]);
        Occasion::create(['id' => '13', 'slug' => Str::slug('Independence Day'),'name' => 'Independence Day','status' => 1]);
        Occasion::create(['id' => '14', 'slug' => Str::slug('Magha Puja'),'name' => 'Magha Puja','status' => 1]);
        Occasion::create(['id' => '15', 'slug' => Str::slug('Mahashivaratri'),'name' => 'Mahashivaratri','status' => 1]);
        Occasion::create(['id' => '16', 'slug' => Str::slug('Duruthu Perahera'),'name' => 'Duruthu Perahera','status' => 1]);
    }
}

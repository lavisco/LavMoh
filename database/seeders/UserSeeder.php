<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin user
        User::create([
            'name' => 'Mary Jane',
            'email' => 'mary@gmail.com',
            'password' => Hash::make('mary1234'),
            'role_id' => '1',
        ]);
        //Seller user
        User::create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' => Hash::make('john1234'),
            'role_id' => '2',
        ]);
        //Buyer user
        User::create([
            'name' => 'Peter Smith',
            'email' => 'peter@gmail.com',
            'password' => Hash::make('peter1234'),
            'role_id' => '3',
        ]);
        //Manager user
        User::create([
            'name' => 'Sarah Brown',
            'email' => 'sarah@gmail.com',
            'password' => Hash::make('sarah1234'),
            'role_id' => '4',
        ]);
    }
}

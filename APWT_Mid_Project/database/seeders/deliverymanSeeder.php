<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class deliverymanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<10;$i++){
            DB::table('deliverymans')->insert([
                'd_username' => Str::random(10),
                'd_name' => Str::random(10),
                'd_email' => Str::random(10).'@gmail.com',
                'd_phone' => 1234567890,
                'd_password' => Hash::make('password'),
                'd_gender' => 'Male',
                'd_dob' => "04.11.1999",
                'd_address' => Str::random(10),
                'd_valid'=>"11.04.2022",
                'd_propic'=>"",
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class customerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<10;$i++){
            DB::table('customers')->insert([
                'c_username' => Str::random(10),
                'c_name' => Str::random(10),
                'c_email' => Str::random(10).'@gmail.com',
                'c_phone' => 1234567890,
                'c_password' => Hash::make('password'),
                'c_gender' => 'Female',
                'c_dob' => "03.11.1999",
                'c_address' => Str::random(10),
                'c_propic'=>"",
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<10;$i++){
            DB::table('products')->insert([
                'p_name' => Str::random(10),
                'p_catergory' => Str::random(5),
                'p_thumbnail' => Str::random(5),
                'p_gallery' => Str::random(5),
                'p_price' => 420,
                'p_stock' => 100,
                'p_color' => Str::random(5),
                'p_size' => 10,
                'p_description' => Str::random(50),
            ]);
        }
    }
}

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
                'p_name' => "ACI Pure Salt",
                'p_category' => "Cooking",
                'p_thumbnail' => "null",
                'p_gallery' => "null",
                'p_price' => 420,
                'p_stock' => 100,
                'p_color' => 'null',
                'p_size' => 10,
                'p_description' => "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium.",
            ]);
        }
    }
}

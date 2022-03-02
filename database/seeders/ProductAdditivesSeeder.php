<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAdditivesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_additives')->insert([
            [
                'product_id' => 1,
                'additive_id' =>2
            ],
            [
                'product_id' => 1,
                'additive_id' =>3
            ],
            [
                'product_id' => 3,
                'additive_id' =>2
            ],
            [
                'product_id' => 3,
                'additive_id' =>3
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductResistancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_resistances')->insert([
            [
                'product_id' => 2,
                'resistance_id' => 3
            ],
            [
                'product_id' => 2,
                'resistance_id' => 4
            ],
            [
                'product_id' => 2,
                'resistance_id' => 7
            ],
            [
                'product_id' => 3,
                'resistance_id' => 1
            ],
            [
                'product_id' => 3,
                'resistance_id' => 2
            ],
            [
                'product_id' => 3,
                'resistance_id' => 3
            ],
            [
                'product_id' => 3,
                'resistance_id' => 5
            ],
            [
                'product_id' => 3,
                'resistance_id' => 9
            ],
            [
                'product_id' => 3,
                'resistance_id' => 10
            ],
            [
                'product_id' => 3,
                'resistance_id' => 15
            ],
        ]);
    }
}

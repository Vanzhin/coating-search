<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductNumbersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_numbers')->insert([
            [
                'product_id' => 1,
                'number_id' =>1
            ],
            [
                'product_id' => 1,
                'number_id' =>2
            ],
            [
                'product_id' => 2,
                'number_id' =>1
            ],
            [
                'product_id' => 2,
                'number_id' =>2
            ],
            [
                'product_id' => 3,
                'number_id' =>1
            ],
            [
                'product_id' => 3,
                'number_id' =>2
            ],
        ]);
    }
}

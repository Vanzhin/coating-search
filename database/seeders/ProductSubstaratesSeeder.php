<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSubstaratesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_substrates')->insert([
            [
                'product_id' => 1,
                'substrate_id' => 1
            ],
            [
                'product_id' => 2,
                'substrate_id' => 1
            ],
            [
                'product_id' => 2,
                'substrate_id' => 4
            ],
            [
                'product_id' => 3,
                'substrate_id' => 1
            ],
            [
                'product_id' => 3,
                'substrate_id' => 2
            ],
            [
                'product_id' => 3,
                'substrate_id' => 3
            ],
            [
                'product_id' => 3,
                'substrate_id' => 4
            ],
        ]);
    }
}

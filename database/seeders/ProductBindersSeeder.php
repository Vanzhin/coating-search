<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductBindersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_binders')->insert([
            [
                'product_id' => 1,
                'binder_id' =>18
            ],
            [
                'product_id' => 2,
                'additive_id' =>19
            ],
            [
                'product_id' => 3,
                'additive_id' =>19
            ],
        ]);
    }
}

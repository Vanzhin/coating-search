<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductEnvironmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_environments')->insert([
            [
                'product_id' => 1,
                'environment_id' =>1
            ],
            [
                'product_id' => 2,
                'environment_id' =>1
            ],
            [
                'product_id' => 2,
                'environment_id' =>2
            ],
            [
                'product_id' => 3,
                'environment_id' =>1
            ],
            [
                'product_id' => 3,
                'environment_id' =>2
            ],
        ]);
    }
}

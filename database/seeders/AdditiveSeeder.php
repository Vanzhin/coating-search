<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdditiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('additives')->insert(
            [
                ['title' => 'цинк'],
                ['title' => 'фосфат цинка'],
                ['title' => 'слюдяной оксид железа (MIO)'],
                ['title' => 'стеклянные чешуйки (GF)'],
                ['title' => 'алюминий'],
                ['title' => 'индикатор температуры'],
                ['title' => 'фтор'],
                ['title' => 'кварцевый песок']
            ]
        );
    }
}

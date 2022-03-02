<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubstrateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('substrates')->insert(
            [
                ['title' => 'сталь'],
                ['title' => 'бетон'],
                ['title' => 'оцинковка'],
                ['title' => 'цветные металлы'],
                ['title' => 'алюминий'],
                ['title' => 'дерево'],
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                ['title' => 'цинк', 'slug' => Str::slug('цинк')],
                ['title' => 'фосфат цинка', 'slug' => Str::slug('фосфат цинка')],
                ['title' => 'слюдяной оксид железа (MIO)', 'slug' => Str::slug('слюдяной оксид железа (MIO)')],
                ['title' => 'стеклянные чешуйки (GF)', 'slug' => Str::slug('стеклянные чешуйки (GF)')],
                ['title' => 'алюминий', 'slug' => Str::slug('алюминий')],
                ['title' => 'индикатор температуры', 'slug' => Str::slug('индикатор температуры')],
                ['title' => 'фтор', 'slug' => Str::slug('фтор')],
                ['title' => 'кварцевый песок', 'slug' => Str::slug('кварцевый песок')]
            ]
        );
    }
}

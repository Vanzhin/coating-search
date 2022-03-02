<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catalogs')->insert(
            [
                ['title' => 'защитные (protective)'],
                ['title' => 'морские (marine)'],
                ['title' => 'огнезащитные (pfp)'],
                ['title' => 'специальные (special)'],


            ]
        );
    }
}

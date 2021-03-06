<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catalogs')->insert($this->getData());
    }

    private function getData()
    {
        $data = [
            ['title' => 'защитные (protective)'],
            ['title' => 'морские (marine)'],
            ['title' => 'огнезащитные (pfp)'],
            ['title' => 'специальные (special)'],

        ];

        for ($i = 0; $i < count($data); $i++){
            $data[$i]['slug'] = Str::slug($data[$i]['title']);
        }
        return $data;
    }
}

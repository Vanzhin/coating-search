<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ResistanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resistances')->insert($this->getData());
    }
    private function getData()
    {
        $data = [
            ['title' => 'морская вода'],
            ['title' => 'пресная вода'],
            ['title' => 'питьевая вода'],
            ['title' => 'горячая вода (от +50)'],
            ['title' => 'химически загрязненная вода'],
            ['title' => 'сырая нефть'],
            ['title' => 'нефтепродукты'],
            ['title' => 'химикаты'],
            ['title' => 'абразивный износ'],
            ['title' => 'авиационное топливо'],
            ['title' => 'брызги и проливы химикатов'],
            ['title' => 'удар'],
            ['title' => 'под изоляцию'],
            ['title' => 'искробезопасность'],
            ['title' => 'хранение зерна'],
            ['title' => 'высокая температура'],
            ['title' => 'адгезия'],
            ['title' => 'катодное отслаивание'],
        ];

        for ($i = 0; $i < count($data); $i++){
            $data[$i]['slug'] = Str::slug($data[$i]['title']);
        }
        return $data;
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('environments')->insert($this->getData());
    }

    private function getData()
    {
        $data = [
            ['title' => 'атмосфера'],
            ['title' => 'погружение в воду'],
            ['title' => 'погружение в почву'],
            ['title' => 'погружение'],

        ];

        for ($i = 0; $i < count($data); $i++){
            $data[$i]['slug'] = Str::slug($data[$i]['title']);
        }
        return $data;
    }
}

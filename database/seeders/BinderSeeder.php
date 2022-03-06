<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BinderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('binders')->insert($this->getData());
    }

    private function getData()
    {
        $data = [
            ['title' => 'акрил'],
            ['title' => 'алкид'],
            ['title' => 'битум'],
            ['title' => 'винил'],
            ['title' => 'винилэфир'],
            ['title' => 'на водной основе'],
            ['title' => 'неорганическое керамическое'],
            ['title' => 'новолак'],
            ['title' => 'полиуретан'],
            ['title' => 'полиэфир'],
            ['title' => 'противообрастающее'],
            ['title' => 'силикон'],
            ['title' => 'силоксан'],
            ['title' => 'фенол'],
            ['title' => 'хлоркаучук'],
            ['title' => 'чистый эпоксид'],
            ['title' => 'эпоксид'],
            ['title' => 'эпоксид с амидным отверждением'],
            ['title' => 'эпоксид с феналкаминовым отверждением'],
            ['title' => 'этилсиликат'],
        ];

        for ($i = 0; $i < count($data); $i++){
            $data[$i]['slug'] = Str::slug($data[$i]['title']);

        }
        return $data;
    }
}

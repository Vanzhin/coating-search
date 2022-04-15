<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert($this->getData());
    }
    private function getData()
    {
        $data = [
            ['title' => 'ppg'],
            ['title' => 'hempel'],
            ['title' => 'jotun'],
            ['title' => 'international'],
            ['title' => 'вмп'],
        ];

        for ($i = 0; $i < count($data); $i++){
            $data[$i]['slug'] = Str::slug($data[$i]['title']);
        }
        return $data;
    }

}

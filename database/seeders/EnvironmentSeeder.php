<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('environments')->insert(
            [
                ['title' => 'атмосфера'],
                ['title' => 'погружение в воду'],
                ['title' => 'погружение в почву'],
            ]
        );
    }
}

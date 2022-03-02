<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(
            [
                [   'title' => 'AMERCOAT 182 ZH HB',
                    'description' => 'двухкомпонентное толстослойное цинк-фосфатное грунтовочное/ межслойное покрытие полиамидного отверждения',
                    'brand_id' => 1,
                    'catalog_id' => 1,
                    'vs' => 55,
                    'dft' => 100,
                    'dry_to_touch' => 3,
                    'dry_to_handle' => 4,
                    'min_int' => 4,
                    'max_int' => 0,
                    'tolerance' => false,
                    'min_temp' => 5,
                    'max_service_temp' =>120,
                    'pds' => null
                ],
                [   'title' => 'AMERCOAT 236',
                    'description' => 'двухкомпонентное многофугкциональное эпоксидное покрытие с феналкаминовым отвердителем',
                    'brand_id' => 1,
                    'catalog_id' => 1,
                    'vs' => 80,
                    'dft' => 100,
                    'dry_to_touch' => 4,
                    'dry_to_handle' => 8,
                    'min_int' => 5,
                    'max_int' => 30,
                    'tolerance' => true,
                    'min_temp' => -7,
                    'max_service_temp' =>120,
                    'pds' => null

                ],
                [   'title' => 'AMERCOAT 240',
                    'description' => 'двухкомпонентное многофугкциональное эпоксидное покрытие с феналкаминовым отвердителем',
                    'brand_id' => 1,
                    'catalog_id' => 1,
                    'vs' => 87,
                    'dft' => 300,
                    'dry_to_touch' => 5,
                    'dry_to_handle' => 10,
                    'min_int' => 5,
                    'max_int' => 90,
                    'tolerance' => true,
                    'min_temp' => -18,
                    'max_service_temp' =>120,
                    'pds' => 'https://docs.td.ppgpmc.com/download/646/2541/amercoat-240--sigmacover-240'
                ],

            ]
        );
    }
}

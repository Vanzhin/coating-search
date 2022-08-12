<?php

namespace Database\Seeders;

use App\Models\Compilation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AddSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::get() as $user){
            if(!$user->slug){
                $user->slug = Str::slug($user->name);
                $user->save();
            }
        }
        foreach (Compilation::get() as $compilation){
            if(!$compilation->slug){
                $compilation->slug = Str::slug($compilation->name);
                $compilation->save();
            }
        }
    }

}

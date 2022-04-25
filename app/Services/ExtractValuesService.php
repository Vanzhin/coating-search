<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ExtractValuesService
{
    public function getValues(string $table, string $column): array
    {
        $data = [];
        $data['min'] = DB::table($table)->min($column);
        $data['max'] = DB::table($table)->max($column);
        $data['avg'] = round(DB::table($table)->average($column), 0,PHP_ROUND_HALF_DOWN);


        return $data;
    }
}

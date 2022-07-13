<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ExtractValuesService
{
    public function getValues(string $table, string $column): array
    {
        $values = DB::table($table)->selectRaw("min($column) as min, max($column) as max, avg($column) as avg")->get('min')->toArray();
        $data = [];

        $data['min'] = $values[0]->min;
        $data['max'] = $values[0]->max;
        $data['avg'] = round($values[0]->avg, 0,PHP_ROUND_HALF_DOWN);

        return $data;
    }
}

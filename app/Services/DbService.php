<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DbService
{
    public function getEnumValues(string $table, string $column) : array
    {
        $raw =DB::select('SELECT SUBSTRING(COLUMN_TYPE,5)
                    FROM information_schema.COLUMNS
                    WHERE TABLE_SCHEMA=?
                    AND TABLE_NAME=?
                    AND COLUMN_NAME=?', [env("DB_DATABASE"), $table, $column]);
           $enums = explode(",", str_replace(['(', ')', '\''], '', current($raw[0])));



        return $enums;
    }
}

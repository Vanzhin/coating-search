<?php

namespace App\Traits;

trait TModel
{
    public static function getFieldsToShow(): array
    {
        return [
            'title' => 'Название',

        ];
    }

    public static function getFieldsToCreate(): array
    {
        return [
            'title' => 'Название',
        ];
    }
}

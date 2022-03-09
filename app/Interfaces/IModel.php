<?php

namespace App\Interfaces;

interface IModel
{
    public static function getFieldsToShow(): array;
    public static function getFieldsToCreate(): array;

}

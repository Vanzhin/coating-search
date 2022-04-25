<?php

namespace App\Models;

use App\Traits\TModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory, TModel;
    protected  $table = 'searches';
    protected $fillable = [
        'title',
        'data',
        'user_id',
        'session_token',
        'description',
        'status',
    ];
    public static function getFieldsToShow(): array
    {
        return [
            'title' => 'название',
            'description' => 'описание',
//            'session_token' => 'id сессии',
            'status' => 'статус',
            'user_id' => 'пользователь',
            'created_at' => 'создан',
            'updated_at' => 'обновлен'

        ];
    }
}

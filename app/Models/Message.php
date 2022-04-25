<?php

namespace App\Models;

use App\Traits\TModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory, TModel;

    protected  $table = 'messages';
    protected $fillable = [
        'title',
        'from_user_id',
        'to_user_id',
        'message',
    ];

}

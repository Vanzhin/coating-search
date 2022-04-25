<?php

namespace App\Models;

use App\Traits\TModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, TModel;

    protected  $table = 'comments';
    protected $fillable = [
        'sender_email',
        'sender_name',
        'target',
        'target_id',
        'sender_id',
        'message'
    ];
}

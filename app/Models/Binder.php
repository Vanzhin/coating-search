<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Binder extends Model
{
    use HasFactory;
    protected  $table = 'binders';
    protected $fillable = [
        'title'
    ];
}

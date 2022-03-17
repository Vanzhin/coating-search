<?php

namespace App\Models;

use App\Traits\TModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Substrate extends Model
{
    use HasFactory, Sluggable, TModel;
    protected  $table = 'substrates';
    protected $fillable = [
        'title'
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
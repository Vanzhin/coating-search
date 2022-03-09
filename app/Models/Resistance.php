<?php

namespace App\Models;

use App\Traits\TModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resistance extends Model
{
    use HasFactory, Sluggable, TModel;
    protected  $table = 'resistances';
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

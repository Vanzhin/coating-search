<?php

namespace App\Models;

use App\Traits\TModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory, Sluggable, TModel;
    protected  $table = 'catalogs';
    protected $fillable = [
        'title'
    ];
    public string $name = 'catalog';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}

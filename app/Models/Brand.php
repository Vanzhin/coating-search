<?php

namespace App\Models;

use App\Interfaces\IModel;
use App\Traits\TModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brand extends Model implements IModel
{
    use HasFactory, Sluggable, TModel;
    protected  $table = 'brands';
    protected $fillable = [
        'title'
    ];
    public string $name = 'brand';

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

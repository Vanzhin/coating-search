<?php

namespace App\Models;

use App\Traits\TModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Number extends Model
{
    use HasFactory, Sluggable, TModel;
    protected  $table = 'numbers';
    protected $fillable = [
        'title'
    ];
    public string $name = 'number';

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_numbers',
            'number_id', 'product_id',
            'id', 'id'
        );
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

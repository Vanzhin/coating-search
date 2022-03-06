<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Additive extends Model
{
    use HasFactory, Sluggable;
    protected  $table = 'additives';
    protected $fillable = [
        'title'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_additives',
            'additive_id', 'product_id',
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

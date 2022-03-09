<?php

namespace App\Models;

use App\Interfaces\IModel;
use App\Traits\TModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Binder extends Model implements IModel
{
    use HasFactory, Sluggable, TModel;
    protected  $table = 'binders';
    protected $fillable = [
        'title'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_binders',
            'binder_id', 'product_id',
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

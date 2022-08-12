<?php

namespace App\Models;

use App\Interfaces\IModel;
use App\Traits\TModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Compilation extends Model implements IModel
{
    use HasFactory, TModel, Sluggable;

    protected $table = 'compilations';
    protected $fillable = [
        'title',
        'user_id',
        'is_private',
        'description',
    ];

    protected $casts = [
        'is_private' => 'boolean'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'compilations_products',
            'compilation_id', 'product_id',
            'id', 'id'
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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

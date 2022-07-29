<?php

namespace App\Models;

use App\Interfaces\IModel;
use App\Traits\TModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Compilation extends Model implements IModel
{
    use HasFactory, TModel;
    protected  $table = 'compilations';
    protected $fillable = [
        'title',
        'user_id',
        'is_private'
    ];

    protected $casts = [
        'is_private' => 'boolean'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'compilations_products',
            'product_id', 'compilation_id',
            'id', 'id'
        );
    }


}

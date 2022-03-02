<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Binder extends Model
{
    use HasFactory;
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
}

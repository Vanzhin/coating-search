<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Environment extends Model
{
    use HasFactory;
    protected  $table = 'environments';
    protected $fillable = [
        'title'
    ];
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_environments',
            'environment_id', 'product_id',
            'id', 'id'
        );
    }

}

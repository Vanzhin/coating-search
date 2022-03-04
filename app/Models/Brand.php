<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brand extends Model
{
    use HasFactory;
    protected  $table = 'brands';
    protected $fillable = [
        'title'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

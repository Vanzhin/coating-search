<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'role',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getFieldsToShow(): array
    {
        return [
            'avatar' => 'Фото',
            'name' => 'Имя',
            'email' => 'Почта',
            'last_login_at' => 'Дата последнего входа',
            'email_verified_at' => 'Дата верификации почты',
            'role' => 'Роль',
            'status' => 'Статус',
        ];
    }

    public static function getFieldsToCreate(): array
    {
        return [
            'name' => 'Имя',
            'email' => 'Почта',
            'role' => 'Роль',
            'status' => 'Статус',
            'password' => 'Пароль'
        ];
    }
    public static function getFieldsToUpdate(): array
    {
        return [
            'name' => 'Имя',
            'email' => 'Почта',
            'role' => 'Роль',
            'status' => 'Статус',
        ];
    }

    public function compilations(): HasMany
    {
        return $this->hasMany(Compilation::class, 'user_id', 'id');
    }

    public function compiledProducts()
    {
        return Product::query()
            ->join('compilations_products as cp','products.id', '=','cp.product_id' )
            ->join('compilations as c','c.id', '=','cp.compilation_id' )
            ->join('users as u','u.id', '=','c.user_id' )
            ->where('u.id', '=', $this->id)
            ->distinct()
            ->get('products.*');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}

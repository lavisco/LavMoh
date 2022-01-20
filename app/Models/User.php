<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'status',
        'role_id'
    ];

    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return $this->avatar ? asset('storage/'.$this->avatar) : "/images/lavisco/img-bg.jpg";
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //buyer_profile:user 1:1
    public function buyer_profile()
    {
        return $this->hasOne(BuyerProfile::class);
    }

    //seller_profiles:user 1:1
    public function seller_profile()
    {
        return $this->hasOne(SellerProfile::class);
    }

    //product:user M:1
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    //product_variations:user M:1
    public function product_variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    //shop:user M:1
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public function shop()
    {
        return $this->hasOne(Shop::class);
    }

    //user:role M:1
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%')
                ->orWhere('email', 'like', '%' . $searchText . '%'));
    }
}

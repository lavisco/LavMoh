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
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

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
        'phone',
        'role_id'
    ];

    //user consts for guest user
    public const GUEST_USER_MAIL = 'guestlavisco@gmail.com';

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

    //giftwraps:user M:1
    public function giftwraps()
    {
        return $this->hasMany(Giftwrap::class);
    }

    //orders:user M:1
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    //receipts:user M:1
    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    //transactions:user M:1
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    //product:user M:1
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    //product:user M:1
    public function latestProducts()
    {
        return $this->products()->with('product_image')->latest()->limit(4);
    }

    //product_variations:user M:1
    public function product_variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    //variation_options:user M:1
    public function variation_options()
    {
        return $this->hasMany(VariationOption::class);
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

    /**
     * Many to many Pivot table relationships
     */
    
    //users:districts M:M
    public function districts()
    {
        return $this->belongsToMany(District::class)->withTimestamps();
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%')
                ->orWhere('email', 'like', '%' . $searchText . '%'));
    }
}

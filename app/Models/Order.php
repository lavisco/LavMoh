<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'orders';

    protected $fillable = [
        'code',
        'name',
        'email',
        'phone',
        'country',
        'address',
        'zipcode',
        'city',
        'district',
        'province',
        'status',
        'total',
        'subtotal',
        'tax',
        'giftwrap_price',
        'shipping_price',
        'discount_price',
        'shop_id',
        'shipping_id',
        'discount_id',
        'giftwrap_id',
        'seller_id',
        'buyer_id',
    ];

    //seller:order 1:M
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    //buyer:order 1:M
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    //discount:order 1:M
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }    

    //shop:order 1:M
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }    

    //shipping:order 1:M
    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }

    //giftwrap:order 1:M
    public function giftwrap()
    {
        return $this->belongsTo(Giftwrap::class);
    }

    //order:receipt 1:1
    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }

    //order_products:order M:1
    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('code', 'like', '%' . $searchText . '%')
                ->orWhere('status', 'like', '%' . $searchText . '%')
            );
    }
}

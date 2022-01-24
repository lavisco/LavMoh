<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cart extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'carts';

    protected $fillable = [
        'total',
        'subtotal',
        'tax',
        'giftwrap_price',
        'shipping_price',
        'discount_price',
        'discount_code',
        'shop_id',
        'shipping_id',
        'order_id',
        'giftwrap_id',
        'seller_id',
        'buyer_id',
    ];

    //seller:cart 1:M
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    //buyer:cart 1:M
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    //shop:cart 1:M
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }    

    //shipping:cart 1:M
    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }

    //order:cart 1:M
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    //giftwrap:cart 1:M
    public function giftwrap()
    {
        return $this->belongsTo(Giftwrap::class);
    }

    //product:cart M:M
    public function products()
    {
        return $this->belongsToMany(Product::class)->using(CartProduct::class)->withTimestamps();
    }
}

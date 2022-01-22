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
        'user_id',
        'shipping_id',
        'order_id',
        'giftwrap_id',
    ];

    //user:cart 1:M
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //user:cart 1:M
    public function shop()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderProductGiftboxVariation extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'order_product_giftbox_variations';

    protected $fillable = [
        'price',
        'quantity',
        'product_id',
        'order_product_id',
    ];

    //product:order_product_giftbox_variations 1:M
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //order_product:order_product_giftbox_variations 1:M
    public function order_product()
    {
        return $this->belongsTo(OrderProduct::class);
    }
}

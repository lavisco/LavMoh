<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    //Indicates if the IDs are auto-incrementing.

	public $incrementing = true;

    protected $table = 'order_products';

    protected $fillable = [
        'base_price',
        'quantity',
        'total', //(base_price+variation_prices)*quantity
        'custom_text',
        'custom_image',
        'has_variations',
        'order_id',
        'product_id',
    ];

    //order_products:order M:1
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    //order_products:product M:1
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //order_products:order_product_variations 1:M
    public function order_product_variations()
    {
        return $this->hasMany(OrderProductVariation::class);
    }

    //order_product:order_product_giftbox_variations 1:M
    public function order_product_giftbox_variations()
    {
        return $this->hasMany(OrderProductGiftboxVariation::class);
    }   
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CartProductVariation extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'cart_product_variations';

    protected $fillable = [
        'price',
        'quantity',
        'total',
        'product_variation_id',
        'cart_product_id',
    ];

    //product_variation:cart_product_variations 1:M
    public function product_variation()
    {
        return $this->belongsTo(ProductVariation::class);
    }

    //cart_product:cart_product_variations 1:M
    public function cart_product()
    {
        return $this->belongsTo(CartProduct::class);
    }
}

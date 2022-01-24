<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Notifications\Notifiable;

class CartProduct extends Pivot
{
    use HasFactory, Notifiable;

    //Indicates if the IDs are auto-incrementing.

	public $incrementing = true;

    protected $table = 'cart_product';

    protected $fillable = [
        'base_price',
        'quantity',
        'total',
        'custom_text',
        'custom_image',
        'has_variations',
        'cart_id',
        'product_id',
    ];

    public function cart_product_variations()
    {
        return $this->hasMany(CartProductVariation::class);
    }
}

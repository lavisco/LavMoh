<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    //Indicates if the IDs are auto-incrementing.

	public $incrementing = true;

    protected $table = 'order_product';

    protected $fillable = [
        'base_price',
        'quantity',
        'total',
        'custom_text',
        'custom_image',
        'has_variations',
        'order_id',
        'product_id',
    ];

    //order_product:order_product_variations 1:M
    public function order_product_variations()
    {
        return $this->hasMany(OrderProductVariation::class);
    }
}

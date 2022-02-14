<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderProductVariation extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'order_product_variations';

    protected $fillable = [
        'price',
        'product_variation_id',
        'order_product_id',
    ];

    //product_variation:order_product_variations 1:M
    public function product_variation()
    {
        return $this->belongsTo(ProductVariation::class);
    }

    //order_product:order_product_variations 1:M
    public function order_product()
    {
        return $this->belongsTo(OrderProduct::class);
    }
}

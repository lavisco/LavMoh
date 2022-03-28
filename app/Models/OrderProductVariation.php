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
        'variation_option_id',
        'order_product_id',
    ];

    //variation_option:order_product_variations 1:M
    public function variation_option()
    {
        return $this->belongsTo(VariationOption::class);
    }

    //order_product:order_product_variations 1:M
    public function order_product()
    {
        return $this->belongsTo(OrderProduct::class);
    }
}

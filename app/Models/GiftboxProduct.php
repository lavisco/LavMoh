<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class GiftboxProduct extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'giftbox_products';

    protected $fillable = [
        'giftbox_id',
        'product_id',
        'quantity',
    ];

    //giftbox_products:product M:1
    public function product()
    {
        return $this->belongsTo(Product::class, 'giftbox_id');
    }

    //giftbox_products:product M:1
    public function childProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

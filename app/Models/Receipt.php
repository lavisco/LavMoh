<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Receipt extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'receipts';

    protected $fillable = [
        'was_paid',
        'was_claimed',
        'status',
        'payment_method',
        'payment_email',
        'has_giftwrap',
        'total',
        'subtotal',
        'tax',
        'giftwrap_price',
        'shipping_price',
        'discount_price',
        'order_id',
        'shop_id',
        'seller_id',
        'buyer_id',
    ];

    //order:receipt 1:1
    public function order()
    {
        return $this->belongsTo(Order::class);
    }    

    //shop:receipt 1:M
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }    

    //seller:receipt 1:M
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    //buyer:receipt 1:M
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%')
                ->orWhere('status', 'like', '%' . $searchText . '%')
                ->orWhere('country', 'like', '%' . $searchText . '%')
                ->orWhere('city', 'like', '%' . $searchText . '%')
                ->orWhere('address', 'like', '%' . $searchText . '%'));
    }
}

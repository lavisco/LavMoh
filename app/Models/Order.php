<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'orders';

    protected $fillable = [
        'code',
        'first_name',
        'last_name',
        'email',
        'phone',

        'address_line_one',
        'address_line_two',
        'zipcode',
        'city',
        'district',
        'state',
        'country',

        'recipient_first_name',
        'recipient_last_name',
        'recipient_email',
        'recipient_phone',
        
        'billing_address_line_one',
        'billing_address_line_two',
        'billing_zipcode',
        'billing_city',
        'billing_district',
        'billing_state',
        'billing_country',

        'delivery_date',
        'status',
        'currency_code',

        'total',
        'subtotal',
        'tax',
        'giftwrap_price',
        'shipping_price',
        'discount_price',
        
        'shop_id',
        'shipping_id',
        'discount_id',
        'giftwrap_id',
        'seller_id',
        'buyer_id',
    ];

    //seller:order 1:M
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    //buyer:order 1:M
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    //discount:order 1:M
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }    

    //shop:order 1:M
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }    

    //shipping:order 1:M
    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }

    //giftwrap:order 1:M
    public function giftwrap()
    {
        return $this->belongsTo(Giftwrap::class);
    }

    //order:receipt 1:1
    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }

    //order:transaction 1:1
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    //order_products:order M:1
    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('code', 'like', '%' . $searchText . '%')
            );
    }

    public function scopeFilterstatus($query, array $filters)
    {
        $query->when($filters['statusFilter'] ?? false, fn($query, $statusFilter) =>
            $query
                ->where('status', $statusFilter)
            );
    }
}

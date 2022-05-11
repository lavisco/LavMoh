<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'transactions';

    protected $fillable = [
        'code',
        'status',
        'total_amount',
        'bank_charge',
        'platform_charge',
        'shop_discount',
        'payable_amount',

        'cleared_by',
        'payment_mode',
        'clearance_date',
        'request_withdrawal_date',
        
        'order_id',
        'user_id',
    ];

    //order:transaction 1:1
    public function order()
    {
        return $this->belongsTo(Order::class);
    }    

    //user(seller):transaction 1:M 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('payment_mode', 'like', '%' . $searchText . '%')
                ->orWhere('cleared_by', 'like', '%' . $searchText . '%')
        );
    }
}

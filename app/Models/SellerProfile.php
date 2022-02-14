<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SellerProfile extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'seller_profiles';

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'country',
        'province',
        'district',
        'city',
        'address',
        'zipcode',
        'billing_address',
        'deposit_account',
        'deposit_name',
        'deposit_bank',
        'deposit_bank_branch',
        'deposit_account_status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('first_name', 'like', '%' . $searchText . '%')
                ->orWhere('last_name', 'like', '%' . $searchText . '%')
                ->orWhere('city', 'like', '%' . $searchText . '%')
            );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BuyerProfile extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'buyer_profiles';

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'country',
        'address',
        'apt_no',
        'zipcode',
        'city',
        'state',
        'billing_country',
        'billing_address',
        'billing_apt_no',
        'billing_zipcode',
        'billing_city',
        'billing_state',
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
            );
    }
}

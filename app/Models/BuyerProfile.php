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
        'email',
        'phone',

        'address_line_one',
        'address_line_two',
        'zipcode',
        'city',
        'district',
        'state',
        'country',

        'billing_address_line_one',
        'billing_address_line_two',
        'billing_zipcode',
        'billing_city',
        'billing_district',
        'billing_state',
        'billing_country',

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
                ->orWhere('state', 'like', '%' . $searchText . '%')
            );
    }
}

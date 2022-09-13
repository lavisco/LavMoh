<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderState extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'order_states';

    protected $fillable = [
        'state',
        'description',
    ];

    //order:order_state M:1
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('state', 'like', '%' . $searchText . '%')
                ->orWhere('description', 'like', '%' . $searchText . '%')
        );
    }
}

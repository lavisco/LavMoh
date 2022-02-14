<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Shipping extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'shippings';

    protected $fillable = [
        'type',
        'price',
        'delivery_time',
        'locations',
        'tracking_opt',
    ];

    //products:shippings M:M
    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
    
    //shipping:order 1:M
    public function order()
    {
        return $this->hasMany(Order::class);
    }

    //scope for searching in table
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('type', 'like', '%' . $searchText . '%'));
    }
}

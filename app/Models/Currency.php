<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Currency extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'currencies';

    protected $fillable = [
        'name',
        'code',
        'symbol',
        'format',
        'exchange_rate',
        'status',
    ];

    //scope for searching in table
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%')
                ->orWhere('code', 'like', '%' . $searchText . '%'));
    }
}

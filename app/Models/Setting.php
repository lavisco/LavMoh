<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Setting extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value',
    ];

    //scope for searching in table
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('key', 'like', '%' . $searchText . '%')
                ->orWhere('value', 'like', '%' . $searchText . '%'));
    }
}

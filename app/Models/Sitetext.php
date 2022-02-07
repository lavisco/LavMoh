<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sitetext extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'sitetexts';

    protected $fillable = [
        'key',
        'content',
    ];

    //scope for searching in table
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('key', 'like', '%' . $searchText . '%'));
    }
}

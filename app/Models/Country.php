<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Country extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'countries';

    protected $fillable = [
        'name',
        'shortname',
        'phonecode',
    ];

    //province:country M:1
    public function provinces()
    {
        return $this->hasMany(Province::class);
    }

    //scope for searching in table
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%')
                ->orWhere('shortname', 'like', '%' . $searchText . '%'));
    }
}

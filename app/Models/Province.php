<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Province extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'provinces';

    protected $fillable = [
        'name',
        'country_id',
    ];

    //province:country M:1
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    //district:province M:1
    public function districts()
    {
        return $this->hasMany(District::class);
    }

    //scope for searching in table
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%'));
    }
}

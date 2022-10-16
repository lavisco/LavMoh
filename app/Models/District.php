<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class District extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'districts';

    protected $fillable = [
        'name',
        'province_id',
    ];

    //district:province M:1
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    //city:district M:1
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    
    /**
     * Many to many Pivot table relationships
     */
    
    //users:districts M:M
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    //scope for searching in table
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%'));
    }
}

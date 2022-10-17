<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class City extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'cities';

    protected $fillable = [
        'has_area',
        'name',
        'postcode',
        'latitude',
        'longitude',
        'district_id',
    ];

    //city:district M:1
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    //area:city M:1
    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    /**
     * Many to many Pivot table relationships
     */
    
    //users:cities M:M
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    //scope for searching in table
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%')
                ->orWhere('postcode', 'like', '%' . $searchText . '%'));
    }
}

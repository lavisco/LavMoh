<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Shop extends Model
{
    use HasFactory, Notifiable;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected $table = 'shops';

    protected $fillable = [
        'name',
        'banner',
        'url',
        'about',
        'rating',
        'user_id',
    ];

    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return $this->banner ? asset('storage/'.$this->banner) : "/images/lavisco/img-bg.jpg";
    }

    //shop:user M:1
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //get only 4 products using \Staudenmeir\EloquentEagerLimit\HasEagerLimit package
    public function products()
    {
        return $this->user()->with('latestProducts')->limit(4);
    }
    
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%'));
    }
}

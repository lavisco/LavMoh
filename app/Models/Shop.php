<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Shop extends Model
{
    use HasFactory, Notifiable;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected $table = 'shops';

    protected $fillable = [
        'name',
        'slug',
        'banner',
        'url',
        'about',
        'rating',
        'country',
        'province',
        'district',
        'city',
        'area',
        'address',
        'zipcode',
        'status',
        'user_id',
    ];

    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return $this->banner ? Storage::disk('s3')->temporaryUrl('public/' . $this->banner, '+2 minutes') : "/images/lavisco/img-bg.jpg";
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

    //shop:receipt 1:M
    public function receipt()
    {
        return $this->hasMany(Receipt::class);
    }
    
    //shop:order 1:M
    public function order()
    {
        return $this->hasMany(Order::class);
    }
    
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%'));
    }
}

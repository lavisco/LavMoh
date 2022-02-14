<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Occasion extends Model
{
    use HasFactory, Notifiable;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected $table = 'occasions';

    protected $fillable = [
        'name',
        'banner',
        'description',
        'status',
        'slug',
    ];

    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return $this->banner ? Storage::disk('s3')->temporaryUrl('public/' . $this->banner, '+2 minutes') : "/images/lavisco/img-bg.jpg";
    }

    //products:occasions M:M
    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    //get only 4 products using \Staudenmeir\EloquentEagerLimit\HasEagerLimit package
    public function latestProducts()
    {
        return $this->products()->with('product_image')->limit(3);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%'));
    }
}

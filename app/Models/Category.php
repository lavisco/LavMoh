<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use HasFactory, Notifiable;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'banner',
        'description',
        'status',
    ];

    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return $this->banner ? asset('storage/'.$this->banner) : "/images/lavisco/img-bg.jpg";
    }

    //product:category M:1
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    //get only 3 products using \Staudenmeir\EloquentEagerLimit\HasEagerLimit package
    public function latestProducts()
    {
        return $this->products()->with('product_image')->limit(3);
    }

    public function productImages()
    {
        return $this->hasManyThrough(ProductImage::class, Product::class);
    }
    
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%'));
    }
}

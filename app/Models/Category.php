<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

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
        'slug',
    ];

    /*
    |--------------------------------------------------------------------------
    | Banner Image Path
    |--------------------------------------------------------------------------
    */
    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return $this->banner ? 
            Storage::disk('s3')->temporaryUrl('public/' . $this->banner, '+2 minutes') 
            : "/images/lavisco/img-bg.jpg";
    }

    //product:category M:1
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    //sub_categories:category M:1
    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class);
    }

    //get only 3 products using \Staudenmeir\EloquentEagerLimit\HasEagerLimit package
    public function latestProducts()
    {
        return $this->products()->with('product_image')->limit(3);
    }

    //get only 3 products using \Staudenmeir\EloquentEagerLimit\HasEagerLimit package
    public function homePageProducts()
    {
        return $this->products()->with('product_image')->limit(6);
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

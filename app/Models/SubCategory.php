<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class SubCategory extends Model
{
    use HasFactory, Notifiable;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected $table = 'sub_categories';

    protected $fillable = [
        'name',
        'banner',
        'groupName',
        'status',
        'slug',
        'category_id',
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

    //sub_categories:category M:1
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //products:sub_categories M:M
    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    //get only 3 products using \Staudenmeir\EloquentEagerLimit\HasEagerLimit package
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

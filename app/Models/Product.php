<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected $table = 'products';

    protected $fillable = [
        'sku',
        'code',
        'title',
        'short_description',
        'description',
        'material',
        'slug',
        'length',
        'width',
        'height',
        'dimensions_unit',
        'weight',
        'weight_unit',
        'base_price',
        'processing_time',
        'has_custom_text',
        'has_custom_image',
        'has_variations',
        'has_inventory',
        'has_giftwrap',
        'quantity',
        'rating',
        'product_state_id',
        'category_id',
        'user_id',
    ];

    //product:user M:1
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //product:category M:1
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //product:product_state M:1
    public function product_state()
    {
        return $this->belongsTo(ProductState::class);
    }

    //products:recipients M:M
    public function recipients()
    {
        return $this->belongsToMany(Recipient::class)->withTimestamps();
    }
    
    //products:occasions M:M
    public function occasions()
    {
        return $this->belongsToMany(Occasion::class)->withTimestamps();
    }

    //products:shippings M:M
    public function shippings()
    {
        return $this->belongsToMany(Shipping::class)->withTimestamps();
    }

    //product_images:product M:1
    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }
    
    //product_images:product M:1
    public function product_image()
    {
        return $this->hasOne(ProductImage::class)->where('primary_image', 1);
    }

    //product_variations:product M:1
    public function product_variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    //product_videos:product M:1
    public function product_videos()
    {
        return $this->hasMany(ProductVideo::class);
    }

    //product:order M:M
    public function orders()
    {
        return $this->belongsToMany(Order::class)->using(OrderProduct::class)->withTimestamps();
    }
    
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('sku', 'like', '%' . $searchText . '%')
                ->orWhere('title', 'like', '%' . $searchText . '%'));
    }
}

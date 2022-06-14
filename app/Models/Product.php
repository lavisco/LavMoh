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

    /**
     * Many to many Pivot table relationships
     */
    
    //products:occasions M:M
    public function occasions()
    {
        return $this->belongsToMany(Occasion::class)->withTimestamps();
    }    

    //products:recipients M:M
    public function recipients()
    {
        return $this->belongsToMany(Recipient::class)->withTimestamps();
    }

    //products:shippings M:M
    public function shippings()
    {
        return $this->belongsToMany(Shipping::class)->withTimestamps();
    }

    //products:sub_categories M:M
    public function sub_categories()
    {
        return $this->belongsToMany(SubCategory::class)->withTimestamps();
    }

    /**
     * Product details relationships
     */

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

    //product_variations:product M:1!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function product_variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    //variations:product M:1
    public function variations()
    {
        return $this->hasMany(Variation::class);
    }

    //variation_options:product M:1
    public function variation_options()
    {
        return $this->hasMany(VariationOption::class);
    }

    //product_videos:product M:1
    public function product_videos()
    {
        return $this->hasMany(ProductVideo::class);
    }

    /**
     * Giftbox product Relationship
     */

    //giftbox_products:product M:1
    public function giftbox_products()
    {
        return $this->hasMany(GiftboxProduct::class, 'giftbox_id');
    }

    /**
     * Order Relationship
     */

    //order_products:product M:1
    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    //product:order_product_giftbox_variations 1:M
    public function order_product_giftbox_variations()
    {
        return $this->hasMany(OrderProductGiftboxVariation::class);
    }    

    /**
     * filter & sort
     */

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('sku', 'like', '%' . $searchText . '%')
                ->orWhere('title', 'like', '%' . $searchText . '%'));
    }
    
    public function scopeSort($query, array $filters)
    {
        //latest(request('sortValue'))
        $query->when($filters['sortValue'] ?? false, fn($query, $sortValue) =>
            $query
                ->latest($sortValue)
            );
    }
}

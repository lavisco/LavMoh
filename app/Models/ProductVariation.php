<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductVariation extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'product_variations';

    protected $fillable = [
        'sku',
        'description',
        'price',
        'quantity',
        'type',
        'type_option',
        'product_state_id',
        'product_id',
        'user_id',
    ];

    //product_variations:user M:1
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //product_variations:product M:1
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    

    //product_variations:variation M:1
    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }

    //product_variations:variation_option M:1
    public function variation_option()
    {
        return $this->belongsTo(VariationOption::class);
    }

    //product_variations:product_state M:1
    public function product_state()
    {
        return $this->belongsTo(ProductState::class);
    }

    //product_variations:order_product_variations 1:M
    public function order_product_variations()
    {
        return $this->hasMany(OrderProductVariation::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('sku', 'like', '%' . $searchText . '%')
                ->orWhere('description', 'like', '%' . $searchText . '%'));
    }
}

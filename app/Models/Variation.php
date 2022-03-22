<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Variation extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'variations';

    protected $fillable = [
        'name',
        'description',
        'product_id',
        'product_state_id',
    ];

    //variations:product M:1
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    

    //variations:variation_option M:1
    public function variation_options()
    {
        return $this->hasMany(VariationOption::class);
    }

    //variations:product_state M:1
    public function product_state()
    {
        return $this->belongsTo(ProductState::class);
    }

    //variations:order_product_variations 1:M!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function order_product_variations()
    {
        return $this->hasMany(OrderProductVariation::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%')
                ->orWhere('description', 'like', '%' . $searchText . '%'));
    }
}

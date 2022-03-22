<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductState extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'product_states';

    protected $fillable = [
        'state',
        'description',
    ];

    //product:product_state M:1
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    //product_variations:product_state M:1!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function product_variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    //variations:product_state M:1
    public function variations()
    {
        return $this->hasMany(Variation::class);
    }

    //variation_options:product_state M:1
    public function variation_options()
    {
        return $this->hasMany(VariationOption::class);
    }
    
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('state', 'like', '%' . $searchText . '%'));
    }
}

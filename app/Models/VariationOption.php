<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class VariationOption extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'variation_options';

    protected $fillable = [
        'name',
        'variation_id',
    ];

    //variation_options:variation M:1
    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }
    
    //product_variations:variation_option M:1
    public function product_variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    //products:shippings M:M
    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%')
            );
    }
}

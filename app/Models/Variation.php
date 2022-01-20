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
    ];

    //variation_options:variation M:1
    public function variation_options()
    {
        return $this->hasMany(VariationOption::class);
    }

    //product_variations:variation M:1
    public function product_variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
        
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%')
            );
    }
}

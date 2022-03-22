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
        'sku',
        'price',
        'quantity',
        'variation_id',
        'product_id',
        'product_state_id',
        'user_id',
    ];

    
    //variation_options:variation M:1
    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }    

    //variation_options:product M:1
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //variation_options:product_state M:1
    public function product_state()
    {
        return $this->belongsTo(ProductState::class);
    }

    //variation_options:user M:1
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%'));
    }
}

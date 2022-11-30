<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TopProduct extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'top_products';

    protected $fillable = [
        'order',
        'product_id',
    ];

        
    //top_product:product 1:1
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //scope for searching in table
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('product_id', 'like', '%' . $searchText . '%'));
    }
}

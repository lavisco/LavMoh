<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Material extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'materials';

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    //products:materials M:M
    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    //scope for searching in table
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%'));
    }
}

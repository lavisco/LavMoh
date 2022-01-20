<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Recipient extends Model
{
    use HasFactory, Notifiable;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected $table = 'recipients';

    protected $fillable = [
        'name',
        'banner',
        'description',
        'status',
    ];

    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return $this->banner ? asset('storage/'.$this->banner) : "/images/lavisco/img-bg.jpg";
    }

    //products:recipients M:M
    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    //get only 4 products using \Staudenmeir\EloquentEagerLimit\HasEagerLimit package
    public function latestProducts()
    {
        return $this->products()->with('product_image')->limit(3);
    }
    
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%'));
    }
}

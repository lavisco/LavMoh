<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HomeSlider extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'home_sliders';

    protected $fillable = [
        'order',
        'name',
        'description',
        'link',
        'banner',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%'));
    }
}

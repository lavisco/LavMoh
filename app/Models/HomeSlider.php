<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class HomeSlider extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'home_sliders';

    protected $fillable = [
        'order',
        'name',
        'description',
        'link',
        'link_text',
        'banner',
    ];

    /*
    |--------------------------------------------------------------------------
    | Banner Image Path
    |--------------------------------------------------------------------------
    */
    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return $this->banner ? 
            Storage::disk('s3')->temporaryUrl('public/' . $this->banner, '+2 minutes') 
            : "/images/lavisco/img-bg.jpg";
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%'));
    }
}

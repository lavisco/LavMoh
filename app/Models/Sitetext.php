<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Sitetext extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'sitetexts';

    protected $fillable = [
        'key',
        'content',
    ];

    /*
    |--------------------------------------------------------------------------
    | Banner Image Path
    |--------------------------------------------------------------------------
    */
    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return $this->content ? 
            Storage::disk('s3')->temporaryUrl('public/' . $this->content, '+2 minutes') 
            : "/images/lavisco/img-bg.jpg";
    }

    //scope for searching in table
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('key', 'like', '%' . $searchText . '%'));
    }
}

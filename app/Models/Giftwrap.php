<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Giftwrap extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'giftwraps';

    protected $fillable = [
        'name',
        'image_path',
    ];

    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return $this->image_path ? asset('storage/'.$this->image_path) : "/images/lavisco/img-bg.jpg";
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%'));
    }
}

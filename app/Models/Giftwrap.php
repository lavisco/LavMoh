<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Giftwrap extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'giftwraps';

    protected $fillable = [
        'name',
        'image_path',
        'status',
        'user_id',
    ];

    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return $this->image_path ? Storage::disk('s3')->temporaryUrl('public/' . $this->image_path, '+2 minutes') : "/images/lavisco/img-bg.jpg";
    }
    
    //giftwrap:user M:1
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //giftwrap:order 1:M
    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%'));
    }
}

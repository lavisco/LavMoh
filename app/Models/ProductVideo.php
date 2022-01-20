<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductVideo extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'product_videos';

    protected $fillable = [
        'video_path',
        'title',
        'product_id',
    ];

    //product_videos:product M:1
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

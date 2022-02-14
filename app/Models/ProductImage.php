<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'product_images';

    protected $fillable = [
        'image_path',
        'title',
        'primary_image',
        'product_id',
    ];

    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return $this->image_path ? Storage::disk('s3')->temporaryUrl('public/' . $this->image_path, '+2 minutes') : "/images/lavisco/img-bg.jpg";
    }

    //product_images:product M:1
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class CustomProductInquiry extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'custom_product_inquiries';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'zipcode',
        'city',
        'district',
        'state',
        'country',
        'description',
        'short_description',
        'delivery_date',
        'image_path',
        'status',
        'product_id',
        'user_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Banner Image Path
    |--------------------------------------------------------------------------
    */
    protected $appends = ['path'];

    public function getPathAttribute()
    {
        return $this->image_path ? 
            Storage::disk('s3')->temporaryUrl('public/' . $this->image_path, '+2 minutes') 
            : "/images/lavisco/img-bg.jpg";
    }

    //custom_product_inquiries:user M:1
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //custom_product_inquiries:product M:1
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('first_name', 'like', '%' . $searchText . '%')
                ->orWhere('last_name', 'like', '%' . $searchText . '%')
                ->orWhere('email', 'like', '%' . $searchText . '%')
                ->orWhere('city', 'like', '%' . $searchText . '%')
            );
    }
}

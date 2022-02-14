<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Discount extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'discounts';

    protected $fillable = [
        'code',
        'price',
    ];

    //discount:order 1:M
    public function order()
    {
        return $this->hasMany(Order::class);
    }

}

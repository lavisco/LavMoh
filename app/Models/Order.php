<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'orders';

    protected $fillable = [
        'total',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

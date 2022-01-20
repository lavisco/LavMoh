<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'roles';

    protected $fillable = ['name', 'description'];

    //role consts after seeding RoleSeeder
    public const IS_ADMIN = 1;
    public const IS_SELLER = 2;
    public const IS_BUYER = 3;
    public const IS_MANAGER = 4;

    //user:role M:1
    public function users()
    {
        return $this->hasMany(User::class);
    }

    //permission:role M:M
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }
    
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['searchText'] ?? false, fn($query, $searchText) =>
            $query
                ->where('name', 'like', '%' . $searchText . '%'));
    }
}

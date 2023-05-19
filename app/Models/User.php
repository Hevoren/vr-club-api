<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    use HasFactory;

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'user_id', 'user_id');
    }

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }
}

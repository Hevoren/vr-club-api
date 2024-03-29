<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'role_id';

    protected $fillable = [
        'role'
    ];

    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}

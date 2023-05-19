<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statuse extends Model
{
    protected $table = 'statuses';
    protected $primaryKey = 'status_id';

    protected $fillable = [
        'status'
    ];

    use HasFactory;

    public function employees()
    {
        return $this->hasMany(Employee::class, 'status_id', 'status_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'status_id',
        'name',
        'surname',
        'mid_name',
        'salary',
        'title',
        'phone_number'
    ];

    use HasFactory;

    public function statuses()
    {
        return $this->belongsTo(Statuse::class, 'status_id', 'status_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'employee_id', 'employee_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'room_id';

    use HasFactory;

    public function vrdevices()
    {
        return $this->belongsTo(VrDevice::class, 'vr_device_id', 'vr_device_id');
    }

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'room_id', 'room_id');
    }
}

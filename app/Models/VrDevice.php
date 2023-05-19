<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VrDevice extends Model
{
    protected $table = 'vr_devices';
    protected $primaryKey = 'vr_device_id';

    use HasFactory;

    public function computers()
    {
        return $this->belongsTo(Computer::class, 'computer_id', 'computer_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'vr_devices_id', 'vr_devices_id');
    }
}

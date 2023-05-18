<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VrDevice extends Model
{
    protected $table = 'vr_devices';
    protected $primaryKey = 'vr_device_id';

    use HasFactory;
}

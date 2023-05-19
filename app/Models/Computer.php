<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    protected $table = 'computers';
    protected $primaryKey = 'computer_id';

    use HasFactory;

    public function vrdevices()
    {
        return $this->hasMany(VrDevice::class, 'computer_id', 'computer_id');
    }
}

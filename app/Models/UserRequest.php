<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    protected $table = 'request';

    protected $primaryKey = 'request_id';

    protected $fillable = [
        'name',
        'phone_number'
    ];

    use HasFactory;
}

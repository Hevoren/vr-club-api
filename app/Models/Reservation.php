<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'reservation_id';

    protected $fillable = [
        'user_id',
        'reservation_time',
        'reservation_time_end',
        'peoples',
        'game_id',
        'room_id',
        'all_price'
    ];

    use HasFactory;

    public function games()
    {
        return $this->belongsTo(Game::class, 'game_id', 'game_id');
    }

    public function rooms()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}

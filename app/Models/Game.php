<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';
    protected $primaryKey = 'game_id';

    use HasFactory;

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'game_id', 'game_id');
    }
}

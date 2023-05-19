<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';
    protected $primaryKey = 'game_id';

    protected $fillable = [
      'game',
      'age_limit',
      'duration',
      'genre',
      'price'
    ];

    use HasFactory;

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'game_id', 'game_id');
    }
}

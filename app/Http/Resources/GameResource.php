<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'game_id' => $this->game_id,
            'game' => $this->game,
            'age_limit' => $this->age_limit,
            'duration' => $this->duration,
            'genre' => $this->genre,
            'price' => $this->price,
    
        ]; 
    }
}

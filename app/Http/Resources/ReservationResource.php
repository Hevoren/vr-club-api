<?php

namespace App\Http\Resources;

use App\Models\Game;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::find($this->user_id);
        $userFullName = $user->surname . ' ' . $user->name;

        return [
            'reservation_id' => $this->reservation_id,
            'user' => $userFullName,
            'reservation_time' => Carbon::parse($this->reservation_time)->format('Y-m-d H:i'),
            'reservation_time_end' => Carbon::parse($this->reservation_time_end)->format('Y-m-d H:i'),
            'peoples' => $this->peoples,
            'game' => Game::find($this->game_id)->game,
            'room' => Room::find($this->room_id)->type_room,
            'all_price' => $this->all_price
        ];
    }
}

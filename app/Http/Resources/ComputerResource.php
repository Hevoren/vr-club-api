<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComputerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'computer_id' => $this->computer_id,
            'graphic_card' => $this->graphic_card,
            'processor' => $this->processor,
            'ram' => $this->ram
        ];
    }
}

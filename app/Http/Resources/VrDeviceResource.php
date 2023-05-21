<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VrDeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'vr_device_id' => $this->vr_device_id,
            'vr_glasses' => $this->vr_glasses,
            'controller' => $this->controller,
            'computer_id' => $this->computer_id
        ];
    }
}

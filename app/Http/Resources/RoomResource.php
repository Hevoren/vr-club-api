<?php

namespace App\Http\Resources;

use App\Models\Employee;
use App\Models\Role;
use App\Models\VrDevice;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $employee = Employee::find($this->employee_id);
        $employeeFullName = $employee->surname . ' ' . $employee->name . ' ' . $employee->mid_name;

        return [
            'room_id' => $this->room_id,
            'type_room' => $this->type_room,
            'vr_device_id' => $this->vr_device_id,
            'employee' => $employeeFullName,
            'price' => $this->price
        ];
    }
}

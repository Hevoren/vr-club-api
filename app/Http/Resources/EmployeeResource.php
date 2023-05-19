<?php

namespace App\Http\Resources;

use App\Models\Statuse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'employee_id' => $this->employee_id,
            'status' => Statuse::find($this->status_id)->status,
            'name' => $this->name,
            'surname' => $this->surname,
            'mid_name' => $this->mid_name,
            'salary' => $this->salary,
            'title' => $this->title,
            'phone_number' => $this->phone_number
        ];
    }
}
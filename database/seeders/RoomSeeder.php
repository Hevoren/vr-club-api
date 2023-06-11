<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::create([
            'type_room' => 'vip',
            'vr_device_id' => 1,
            'employee_id' => 1,
            'price' => 1200
        ]);
    }
}

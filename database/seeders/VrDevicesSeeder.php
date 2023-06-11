<?php

namespace Database\Seeders;

use App\Models\VrDevice;
use Illuminate\Database\Seeder;

class VrDevicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VrDevice::create([
            'vr_glasses' => 'OCULUS rift',
            'controller' => 'dualshock 4',
            'computer_id' => 1
        ]);
    }
}

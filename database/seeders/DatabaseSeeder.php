<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Default Parking Slots
        $slots = ['D1', 'D2', 'D3', 'D4'];
        foreach ($slots as $slot) {
            \App\Models\ParkingSlot::updateOrCreate(
                ['slot_name' => $slot],
                ['status' => 'TERSEDIA']
            );
        }

        // 2. Create Dummy Parking Logs
        \App\Models\ParkingLog::create([
            'slot' => 'D1',
            'status' => 'TERISI',
            'plat' => 'DA 6769 LAA',
            'masuk' => '2026-05-23 09:00:00',
            'keluar' => null,
        ]);

        \App\Models\ParkingLog::create([
            'slot' => 'D2',
            'status' => 'KELUAR',
            'plat' => 'B 1234 ABC',
            'masuk' => '2026-05-23 08:30:00',
            'keluar' => '2026-05-23 10:15:00',
        ]);

        \App\Models\ParkingLog::create([
            'slot' => 'D3',
            'status' => 'TERISI',
            'plat' => 'D 999 SS',
            'masuk' => '2026-05-23 11:00:00',
            'keluar' => null,
        ]);
    }
}

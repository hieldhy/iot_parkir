<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkingSlot;
use App\Models\ParkingLog;

class ParkingController extends Controller
{
    // Dashboard
    public function index()
    {
        $slots = ParkingSlot::all();
        $logs = ParkingLog::orderBy('masuk', 'desc')->limit(10)->get();

        return view('dashboard', compact('slots', 'logs'));
    }

    // API dari YOLO
    public function update(Request $request)
    {
        foreach ($request->slots as $slot) {

            ParkingSlot::updateOrCreate(
                ['slot_name' => $slot['name']],
                ['status' => $slot['status']]
            );

            if ($slot['status'] == 'TERISI') {
                // Mencegah duplikasi: hanya buat log baru jika belum ada mobil di slot ini yang belum keluar
                $existingLog = ParkingLog::where('slot', $slot['name'])
                    ->whereNull('keluar')
                    ->first();

                if (!$existingLog) {
                    ParkingLog::create([
                        'slot' => $slot['name'],
                        'status' => 'TERISI',
                        'plat' => $slot['plate'] ?? null,
                        'masuk' => now()
                    ]);
                }
            } else if ($slot['status'] == 'TERSEDIA') {
                // Logika ketika mobil keluar: cari log aktif terakhir di slot ini lalu isi kolom 'keluar'
                $activeLog = ParkingLog::where('slot', $slot['name'])
                    ->whereNull('keluar')
                    ->orderBy('masuk', 'desc')
                    ->first();

                if ($activeLog) {
                    $activeLog->update([
                        'keluar' => now(),
                        'status' => 'KELUAR'
                    ]);
                }
            }
        }

        return response()->json(['success' => true]);
    }
}
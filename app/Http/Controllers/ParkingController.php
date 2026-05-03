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
                ParkingLog::create([
                    'slot' => $slot['name'],
                    'vehicle_type' => $slot['type'] ?? null,
                    'color' => $slot['color'] ?? null,
                    'plate' => $slot['plate'] ?? null,
                    'masuk' => now()
                ]);
            }
        }

        return response()->json(['success' => true]);
    }
}
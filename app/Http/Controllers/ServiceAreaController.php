<?php

// app/Http/Controllers/Mitra/ServiceAreaController.php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceAreaController extends Controller
{
    public function index()
    {
        $mitra = Auth::user()->mitra;
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->take(10)
            ->get();

        return view('mitra.area', compact('mitra', 'notifications'));
    }

    public function updateLocation(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $mitra = Auth::user()->mitra;
        $mitra->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return response()->json(['message' => 'Lokasi berhasil diperbarui']);
    }

    public function updateServiceAreas(Request $request)
    {
        $request->validate([
            'service_areas' => 'required|array',
            'service_areas.*' => 'string|max:255',
        ]);

        $mitra = Auth::user()->mitra;
        $mitra->update([
            'service_area' => $request->service_areas,
        ]);

        return response()->json(['message' => 'Area layanan berhasil diperbarui']);
    }
}
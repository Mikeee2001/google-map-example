<?php

namespace App\Http\Controllers;

use App\Models\Emergency;
use Illuminate\Http\Request;

class EmergencyController extends Controller
{
    public function index()
    {
        return view('emergency.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // Original table
        Emergency::create([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true
        ]);
    }


    public function emergencyMap()
    {
        return view('admin.emergency-map');
    }

    // public function data()
    // {
    //     return EmergencyRequest::with('user')
    //         ->where('status', 'pending')
    //         ->latest()
    //         ->get();
    // }

    public function getEmergencyData()
    {
        return Emergency::latest()->get();
    }

}

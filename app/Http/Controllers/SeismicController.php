<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class SeismicController extends Controller
{
    public function index()
    {
        $title = 'View';
        
        $gpsPosition = [
            'latitude' => -6.2088,
            'longitude' => 106.8456
        ];

        return view('data-view', compact('gpsPosition', 'title'));
    }
    
    public function quality()
    {
        $title = 'Quality';
        return view('quality', compact('title'));
    }
    
    public function getTime()
    {
        $time = Carbon::now('Asia/Jakarta')->format('H:i:s');
        
        return response()->json(['time' => $time]);

        // return response()->json([
        //     'time' => now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s')
        // ]);
    }
}

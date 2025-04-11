<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class TimeController extends Controller
{
    public function getTime()
    {
        // Ambil waktu UTC+7
        $time = Carbon::now('Asia/Jakarta')->format('H:i:s');
        // $now = Carbon::now('Asia/Jakarta');
        // $time = $now->format('H:i:s') . '.' . substr($now->format('u'), 0, 3);

        return response()->json(['time' => $time]);
    }
}


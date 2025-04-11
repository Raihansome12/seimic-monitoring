<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class SeismicController extends Controller
{
    public function index()
    {
        $title = 'View';
        return view('data-view', compact('title'));
    }
    
    public function quality()
    {
        $title = 'Quality';
        return view('quality', compact('title'));
    }
}

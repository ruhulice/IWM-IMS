<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapSettingsController extends Controller
{
    public function index()
    {
        return view('map_dash.dashboard');
    }
}

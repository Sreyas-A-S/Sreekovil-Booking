<?php

namespace App\Http\Controllers;

use App\Models\Temple;
use App\Models\Hotel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $templeCount = Temple::count();
        $hotelCount = Hotel::count();
        
        return view('dashboard', compact('templeCount', 'hotelCount'));
    }
}

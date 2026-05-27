<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Support\HomeSettings;
use Illuminate\View\View;

class HomePageController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'settings' => HomeSettings::load(),
            'vehicles' => Kendaraan::where('status', 'tersedia')->latest()->get(),
        ]);
    }
}
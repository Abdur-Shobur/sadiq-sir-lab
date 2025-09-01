<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamDashboardController extends Controller
{
    /**
     * Show team dashboard
     */
    public function index()
    {
        $team = auth()->guard('team')->user();
        return view('team.dashboard.index', compact('team'));
    }
}

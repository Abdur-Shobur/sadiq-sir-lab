<?php
namespace App\Http\Controllers;

use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        $banner = Banner::active()->first();
        return view('home', compact('banner'));
    }
}

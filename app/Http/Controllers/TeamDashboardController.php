<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamDashboardController extends Controller
{
    public function index()
    {
        $team = auth()->guard('team')->user();

        // Only the six modules requested
        $stats = [
            'blogs'     => ['total' => \App\Models\Blog::count(), 'active' => \App\Models\Blog::active()->count()],
            'contacts'  => ['total' => \App\Models\ContactMessage::count(), 'unread' => \App\Models\ContactMessage::unread()->count()],
            'events'    => ['total' => \App\Models\Event::count(), 'active' => \App\Models\Event::active()->count()],
            'galleries' => ['total' => \App\Models\Gallery::count(), 'active' => \App\Models\Gallery::active()->count()],
            'projects'  => ['total' => \App\Models\Project::count(), 'active' => \App\Models\Project::active()->count()],
            'research'  => ['total' => \App\Models\Research::count(), 'active' => \App\Models\Research::where('is_active', true)->count()],
        ];

        $recent = [
            'blogs'     => \App\Models\Blog::with('category')->latest()->take(5)->get(),
            'contacts'  => \App\Models\ContactMessage::latest()->take(5)->get(),
            'events'    => \App\Models\Event::latest()->take(5)->get(),
            'galleries' => \App\Models\Gallery::latest()->take(5)->get(),
            'projects'  => \App\Models\Project::with('category')->latest()->take(5)->get(),
            'research'  => \App\Models\Research::latest()->take(5)->get(),
        ];

        return view('team.dashboard.index', compact('team', 'stats', 'recent'));
    }
}

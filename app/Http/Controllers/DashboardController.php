<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\Event;
use App\Models\News;
use App\Models\Project;
use App\Models\Publication;
use App\Models\SocialMedia;
use App\Models\Team;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects'     => ['total' => Project::count(), 'active' => Project::active()->count()],
            'teams'        => ['total' => Team::count(), 'active' => Team::active()->count()],
            'blogs'        => ['total' => Blog::count(), 'active' => Blog::active()->count()],
            'events'       => ['total' => Event::count(), 'active' => Event::active()->count()],
            'news'         => ['total' => News::count(), 'active' => News::active()->count()],
            'messages'     => ['total' => ContactMessage::count(), 'unread' => ContactMessage::unread()->count()],
            'publications' => ['active' => Publication::active()->count()],
            'social'       => ['active' => SocialMedia::where('is_active', true)->count()],
        ];

        $recentBlogs    = Blog::with('category')->latest()->take(5)->get();
        $recentProjects = Project::with('category')->ordered()->take(5)->get();
        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('dashboard.index', compact('stats', 'recentBlogs', 'recentProjects', 'recentMessages'));
    }
}

<?php
namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Event;
use App\Models\HomeTeam;
use App\Models\News;
use App\Models\Project;
use App\Models\Team;
use App\Models\TeamCategory;

class HomeController extends Controller
{
    public function index()
    {
        $banner = Banner::active()->first();

        // Get featured teams for home page, fallback to latest teams if none selected
        $teams = HomeTeam::with('team')
            ->active()
            ->ordered()
            ->get()
            ->pluck('team');

        // If no teams are selected for home page, get the latest 4 teams
        if ($teams->isEmpty()) {
            $teams = Team::active()->orderBy('created_at', 'desc')->take(4)->get();
        }

        $blogs = Blog::with('category')->active()->latest()->take(3)->get();
        return view('home', compact('banner', 'teams', 'blogs'));
    }

    public function projects()
    {
        $projects = Project::with('category')->active()->ordered()->get();
        return view('projects', compact('projects'));
    }

    public function events()
    {
        $events = Event::active()->ordered()->get();
        return view('events', compact('events'));
    }

    public function team()
    {
        // Get teams grouped by categories with sort order
        $categories = TeamCategory::active()
            ->with(['teams' => function ($query) {
                $query->active()->ordered();
            }])
            ->ordered()
            ->get();

        // Also get teams without categories for backward compatibility
        $uncategorizedTeams = Team::active()
            ->whereNull('category_id')
            ->ordered()
            ->get();

        return view('team', compact('categories', 'uncategorizedTeams'));
    }

    public function blog()
    {
        $query = Blog::with('category')->active()->latest();

        // Filter by category if requested
        if (request('category')) {
            $query->where('blog_category_id', request('category'));
        }

        $blogs      = $query->paginate(9);
        $categories = BlogCategory::active()->get();
        return view('blog', compact('blogs', 'categories'));
    }

    public function blogDetail($id)
    {
        $blog         = Blog::with('category')->active()->findOrFail($id);
        $relatedBlogs = Blog::with('category')
            ->active()
            ->where('id', '!=', $id)
            ->where('blog_category_id', $blog->blog_category_id)
            ->latest()
            ->limit(3)
            ->get();

        return view('blog-detail', compact('blog', 'relatedBlogs'));
    }

    public function news()
    {
        $news = News::active()->latest()->paginate(9);
        return view('news', compact('news'));
    }

    public function newsDetail($id)
    {
        $news        = News::active()->findOrFail($id);
        $relatedNews = News::active()
            ->where('id', '!=', $id)
            ->latest()
            ->limit(3)
            ->get();

        return view('news-detail', compact('news', 'relatedNews'));
    }
}

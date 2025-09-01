<?php
namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Event;
use App\Models\News;
use App\Models\Project;
use App\Models\Team;

class HomeController extends Controller
{
    public function index()
    {
        $banner = Banner::active()->first();
        return view('home', compact('banner'));
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
        // Show only active teams
        $teams = Team::active()->orderBy('created_at', 'desc')->get();

        return view('team', compact('teams'));
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

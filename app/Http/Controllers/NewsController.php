<?php
namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::latest()->get();
        return view('dashboard.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content'     => 'required|string',
            'status'      => 'boolean',
        ]);

        $data           = $request->all();
        $data['status'] = $request->boolean('status');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath     = $request->file('image')->store('news', 'public');
            $data['image'] = $imagePath;
        }

        News::create($data);

        return redirect()->route('dashboard.news.index')
            ->with('success', 'News article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('dashboard.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('dashboard.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content'     => 'required|string',
            'status'      => 'boolean',
        ]);

        $data           = $request->all();
        $data['status'] = $request->boolean('status');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }

            $imagePath     = $request->file('image')->store('news', 'public');
            $data['image'] = $imagePath;
        }

        $news->update($data);

        return redirect()->route('dashboard.news.index')
            ->with('success', 'News article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        // Delete image if exists
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('dashboard.news.index')
            ->with('success', 'News article deleted successfully.');
    }
}

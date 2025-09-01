<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogCategories = BlogCategory::orderBy('created_at', 'desc')->get();
        return view('dashboard.blog-categories.index', compact('blogCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.blog-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories',
            'status' => 'boolean',
        ]);

        $data = $request->all();
        $data['status'] = $request->boolean('status');

        BlogCategory::create($data);

        return redirect()->route('dashboard.blog-categories.index')
            ->with('success', 'Blog category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogCategory $blogCategory)
    {
        return view('dashboard.blog-categories.show', compact('blogCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogCategory $blogCategory)
    {
        return view('dashboard.blog-categories.edit', compact('blogCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogCategory $blogCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name,' . $blogCategory->id,
            'status' => 'boolean',
        ]);

        $data = $request->all();
        $data['status'] = $request->boolean('status');

        $blogCategory->update($data);

        return redirect()->route('dashboard.blog-categories.index')
            ->with('success', 'Blog category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();

        return redirect()->route('dashboard.blog-categories.index')
            ->with('success', 'Blog category deleted successfully.');
    }
}

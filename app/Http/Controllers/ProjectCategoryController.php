<?php

namespace App\Http\Controllers;

use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProjectCategory::orderBy('name', 'asc')->get();
        return view('dashboard.project-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.project-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:project_categories,name',
            'is_active' => 'boolean',
        ]);

        ProjectCategory::create([
            'name' => $request->name,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('dashboard.project-categories.index')
            ->with('success', 'Project category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectCategory $projectCategory)
    {
        return view('dashboard.project-categories.show', compact('projectCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectCategory $projectCategory)
    {
        return view('dashboard.project-categories.edit', compact('projectCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectCategory $projectCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:project_categories,name,' . $projectCategory->id,
            'is_active' => 'boolean',
        ]);

        $projectCategory->update([
            'name' => $request->name,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('dashboard.project-categories.index')
            ->with('success', 'Project category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectCategory $projectCategory)
    {
        try {
            $projectCategory->delete();

            return redirect()->route('dashboard.project-categories.index')
                ->with('success', 'Project category deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete project category: ' . $e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('category')->orderBy('created_at', 'desc')->get();
        return view('dashboard.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProjectCategory::active()->ordered()->get();
        return view('dashboard.projects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'project_category_id' => 'required|exists:project_categories,id',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $data['image'] = $imagePath;
        }

        Project::create($data);

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('dashboard.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories = ProjectCategory::active()->ordered()->get();
        return view('dashboard.projects.edit', compact('project', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'project_category_id' => 'required|exists:project_categories,id',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $imagePath = $request->file('image')->store('projects', 'public');
            $data['image'] = $imagePath;
        }

        $project->update($data);

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            // Delete image file
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }

            $project->delete();

            return redirect()->route('dashboard.projects.index')
                ->with('success', 'Project deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete project: ' . $e->getMessage()]);
        }
    }

    /**
     * Display projects for public view.
     */
    public function publicIndex()
    {
        $projects = Project::with('category')->active()->ordered()->get();
        return view('projects', compact('projects'));
    }

    /**
     * Display single project details.
     */
    public function showProject($id)
    {
        $project = Project::with('category')->active()->findOrFail($id);
        return view('project-details', compact('project'));
    }
}

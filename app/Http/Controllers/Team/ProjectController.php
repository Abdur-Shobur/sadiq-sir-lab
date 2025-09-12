<?php
namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
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
        $projects = Project::with('category')->orderBy('created_at', 'desc')->paginate(10);
        return view('team.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProjectCategory::active()->ordered()->get();
        return view('team.projects.create', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'               => 'required|string|max:255',
            'subtitle'            => 'nullable|string|max:255',
            'content'             => 'required|string',
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'project_category_id' => 'required|exists:project_categories,id',
            'is_active'           => 'boolean',
        ]);

        $data              = $request->only(['title', 'subtitle', 'content', 'project_category_id']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($data);

        return redirect()->route('team.projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load('category');
        return view('team.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories = ProjectCategory::active()->ordered()->get();
        return view('team.projects.edit', compact('project', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title'               => 'required|string|max:255',
            'subtitle'            => 'nullable|string|max:255',
            'content'             => 'required|string',
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'project_category_id' => 'required|exists:project_categories,id',
            'is_active'           => 'boolean',
        ]);

        $data              = $request->only(['title', 'subtitle', 'content', 'project_category_id']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);

        return redirect()->route('team.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('team.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}

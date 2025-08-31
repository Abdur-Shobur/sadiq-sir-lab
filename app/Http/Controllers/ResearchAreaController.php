<?php

namespace App\Http\Controllers;

use App\Models\ResearchArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResearchAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $researchAreas = ResearchArea::orderBy('order', 'asc')->get();
        return view('dashboard.research-areas.index', compact('researchAreas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.research-areas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'background_color' => 'required|string|max:50',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->boolean('is_active');
        $data['order'] = $request->input('order', 0);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('research-areas', 'public');
            $data['image'] = $imagePath;
        }

        ResearchArea::create($data);

        return redirect()->route('dashboard.research-areas.index')
            ->with('success', 'Research Area created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ResearchArea $researchArea)
    {
        return view('dashboard.research-areas.show', compact('researchArea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResearchArea $researchArea)
    {
        return view('dashboard.research-areas.edit', compact('researchArea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResearchArea $researchArea)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'background_color' => 'required|string|max:50',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->boolean('is_active');
        $data['order'] = $request->input('order', 0);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($researchArea->image) {
                Storage::disk('public')->delete($researchArea->image);
            }
            $imagePath = $request->file('image')->store('research-areas', 'public');
            $data['image'] = $imagePath;
        }

        $researchArea->update($data);

        return redirect()->route('dashboard.research-areas.index')
            ->with('success', 'Research Area updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResearchArea $researchArea)
    {
        try {
            // Delete image file
            if ($researchArea->image) {
                Storage::disk('public')->delete($researchArea->image);
            }

            $researchArea->delete();

            return redirect()->route('dashboard.research-areas.index')
                ->with('success', 'Research Area deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete research area: ' . $e->getMessage()]);
        }
    }
}

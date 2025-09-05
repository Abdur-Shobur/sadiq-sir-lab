<?php
namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = GalleryCategory::withCount('galleries')->orderBy('created_at', 'desc')->get();
        return view('dashboard.gallery-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.gallery-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:gallery_categories,name',
            'slug'        => 'nullable|string|max:255|unique:gallery_categories,slug',
            'description' => 'nullable|string',
            'is_active'   => 'boolean',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        GalleryCategory::create($data);

        return redirect()->route('dashboard.gallery-categories.index')
            ->with('success', 'Gallery category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GalleryCategory $galleryCategory)
    {
        $galleryCategory->load('galleries');
        return view('dashboard.gallery-categories.show', compact('galleryCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GalleryCategory $galleryCategory)
    {
        return view('dashboard.gallery-categories.edit', compact('galleryCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GalleryCategory $galleryCategory)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:gallery_categories,name,' . $galleryCategory->id,
            'slug'        => 'nullable|string|max:255|unique:gallery_categories,slug,' . $galleryCategory->id,
            'description' => 'nullable|string',
            'is_active'   => 'boolean',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $galleryCategory->update($data);

        return redirect()->route('dashboard.gallery-categories.index')
            ->with('success', 'Gallery category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryCategory $galleryCategory)
    {
        try {
            // Check if category has galleries
            if ($galleryCategory->galleries()->count() > 0) {
                return redirect()->back()
                    ->withErrors(['error' => 'Cannot delete category that has galleries. Please delete all galleries first.']);
            }

            $galleryCategory->delete();

            return redirect()->route('dashboard.gallery-categories.index')
                ->with('success', 'Gallery category deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete gallery category: ' . $e->getMessage()]);
        }
    }
}

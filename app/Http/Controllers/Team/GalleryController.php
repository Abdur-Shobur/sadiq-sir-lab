<?php
namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::with('category')->orderBy('created_at', 'desc')->paginate(10);
        return view('team.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = GalleryCategory::active()->get();
        return view('team.galleries.create', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'               => 'required|string|max:255',
            'description'         => 'nullable|string',
            'image'               => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'is_active'           => 'boolean',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath     = $request->file('image')->store('galleries', 'public');
            $data['image'] = $imagePath;
        }

        Gallery::create($data);

        return redirect()->route('team.galleries.index')
            ->with('success', 'Gallery item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        $gallery->load('category');
        return view('team.galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $categories = GalleryCategory::active()->get();
        return view('team.galleries.edit', compact('gallery', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title'               => 'required|string|max:255',
            'description'         => 'nullable|string',
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'is_active'           => 'boolean',
        ]);

        $data = $request->except(['image']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $imagePath     = $request->file('image')->store('galleries', 'public');
            $data['image'] = $imagePath;
        }

        $gallery->update($data);

        return redirect()->route('team.galleries.index')
            ->with('success', 'Gallery item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('team.galleries.index')
            ->with('success', 'Gallery item deleted successfully.');
    }
}

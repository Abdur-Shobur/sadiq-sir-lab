<?php
namespace App\Http\Controllers;

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
        $galleries = Gallery::with('category')->orderBy('order', 'asc')->orderBy('created_at', 'desc')->get();
        return view('dashboard.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = GalleryCategory::active()->get();
        return view('dashboard.galleries.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'title'               => 'required|string|max:255',
            'description'         => 'nullable|string',
            'image'               => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link'                => 'nullable|url',
            'is_active'           => 'boolean',
            'order'               => 'nullable|integer|min:0',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');
        $data['order']     = $request->input('order', 0);

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }

        Gallery::create($data);

        return redirect()->route('dashboard.galleries.index')
            ->with('success', 'Gallery item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        $gallery->load('category');
        return view('dashboard.galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $categories = GalleryCategory::active()->get();
        return view('dashboard.galleries.edit', compact('gallery', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'title'               => 'required|string|max:255',
            'description'         => 'nullable|string',
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link'                => 'nullable|url',
            'is_active'           => 'boolean',
            'order'               => 'nullable|integer|min:0',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');
        $data['order']     = $request->input('order', 0);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }

        $gallery->update($data);

        return redirect()->route('dashboard.galleries.index')
            ->with('success', 'Gallery item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        try {
            // Delete image if exists
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }

            $gallery->delete();

            return redirect()->route('dashboard.galleries.index')
                ->with('success', 'Gallery item deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete gallery item: ' . $e->getMessage()]);
        }
    }
}

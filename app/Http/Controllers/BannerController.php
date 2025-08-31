<?php
namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'desc')->get();
        return view('dashboard.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'              => 'required|string|max:255',
            'subtitle'           => 'required|string|max:255',
            'description'        => 'required|string',
            'action_button_text' => 'required|string|max:255',
            'action_button_link' => 'required|string|max:255',
            'banner_image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_active'          => 'boolean',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('banner_image')) {
            $imagePath            = $request->file('banner_image')->store('banners', 'public');
            $data['banner_image'] = $imagePath;
        }

        Banner::create($data);

        return redirect()->route('dashboard.banners.index')
            ->with('success', 'Banner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        return view('dashboard.banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('dashboard.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title'              => 'required|string|max:255',
            'subtitle'           => 'required|string|max:255',
            'description'        => 'required|string',
            'action_button_text' => 'required|string|max:255',
            'action_button_link' => 'required|string|max:255',
            'banner_image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_active'          => 'boolean',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('banner_image')) {
            // Delete old image if exists
            if ($banner->banner_image) {
                Storage::disk('public')->delete($banner->banner_image);
            }
            $imagePath            = $request->file('banner_image')->store('banners', 'public');
            $data['banner_image'] = $imagePath;
        }

        $banner->update($data);

        return redirect()->route('dashboard.banners.index')
            ->with('success', 'Banner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        try {
            // Delete image file
            if ($banner->banner_image) {
                Storage::disk('public')->delete($banner->banner_image);
            }

            $banner->delete();

            return redirect()->route('dashboard.banners.index')
                ->with('success', 'Banner deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete banner: ' . $e->getMessage()]);
        }
    }
}

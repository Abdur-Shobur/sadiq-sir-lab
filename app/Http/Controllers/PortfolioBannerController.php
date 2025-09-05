<?php
namespace App\Http\Controllers;

use App\Models\PortfolioBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolioBanners = PortfolioBanner::orderBy('order', 'asc')->orderBy('created_at', 'desc')->get();
        return view('dashboard.portfolio-banners.index', compact('portfolioBanners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.portfolio-banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'subtitle'        => 'nullable|string|max:255',
            'description'     => 'nullable|string',
            'additional_text' => 'nullable|string',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_active'       => 'boolean',
            'order'           => 'nullable|integer|min:0',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        // Set default order if not provided
        if (! $data['order']) {
            $data['order'] = PortfolioBanner::max('order') + 1;
        }

        if ($request->hasFile('image')) {
            $imagePath     = $request->file('image')->store('portfolio-banners', 'public');
            $data['image'] = $imagePath;
        }

        PortfolioBanner::create($data);

        return redirect()->route('dashboard.portfolio-banners.index')
            ->with('success', 'Portfolio Banner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PortfolioBanner $portfolioBanner)
    {
        return view('dashboard.portfolio-banners.show', compact('portfolioBanner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PortfolioBanner $portfolioBanner)
    {
        return view('dashboard.portfolio-banners.edit', compact('portfolioBanner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PortfolioBanner $portfolioBanner)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'subtitle'        => 'nullable|string|max:255',
            'description'     => 'nullable|string',
            'additional_text' => 'nullable|string',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_active'       => 'boolean',
            'order'           => 'nullable|integer|min:0',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($portfolioBanner->image) {
                Storage::disk('public')->delete($portfolioBanner->image);
            }
            $imagePath     = $request->file('image')->store('portfolio-banners', 'public');
            $data['image'] = $imagePath;
        }

        $portfolioBanner->update($data);

        return redirect()->route('dashboard.portfolio-banners.index')
            ->with('success', 'Portfolio Banner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PortfolioBanner $portfolioBanner)
    {
        try {
            // Delete image file
            if ($portfolioBanner->image) {
                Storage::disk('public')->delete($portfolioBanner->image);
            }

            $portfolioBanner->delete();

            return redirect()->route('dashboard.portfolio-banners.index')
                ->with('success', 'Portfolio Banner deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete portfolio banner: ' . $e->getMessage()]);
        }
    }

    /**
     * Toggle portfolio banner active status
     */
    public function toggleStatus(PortfolioBanner $portfolioBanner)
    {
        $portfolioBanner->update(['is_active' => ! $portfolioBanner->is_active]);

        $status = $portfolioBanner->is_active ? 'activated' : 'deactivated';
        return redirect()->back()
            ->with('success', "Portfolio Banner {$status} successfully.");
    }
}

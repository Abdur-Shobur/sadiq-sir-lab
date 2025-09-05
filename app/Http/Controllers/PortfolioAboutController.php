<?php
namespace App\Http\Controllers;

use App\Models\PortfolioAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioAboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolioAbouts = PortfolioAbout::orderBy('created_at', 'desc')->get();
        return view('dashboard.portfolio-abouts.index', compact('portfolioAbouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.portfolio-abouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image1'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image2'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_active'   => 'boolean',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image1')) {
            $imagePath      = $request->file('image1')->store('portfolio-abouts', 'public');
            $data['image1'] = $imagePath;
        }

        if ($request->hasFile('image2')) {
            $imagePath      = $request->file('image2')->store('portfolio-abouts', 'public');
            $data['image2'] = $imagePath;
        }

        PortfolioAbout::create($data);

        return redirect()->route('dashboard.portfolio-abouts.index')
            ->with('success', 'Portfolio About created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PortfolioAbout $portfolioAbout)
    {
        return view('dashboard.portfolio-abouts.show', compact('portfolioAbout'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PortfolioAbout $portfolioAbout)
    {
        return view('dashboard.portfolio-abouts.edit', compact('portfolioAbout'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PortfolioAbout $portfolioAbout)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image1'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image2'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_active'   => 'boolean',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image1')) {
            // Delete old image if exists
            if ($portfolioAbout->image1) {
                Storage::disk('public')->delete($portfolioAbout->image1);
            }
            $imagePath      = $request->file('image1')->store('portfolio-abouts', 'public');
            $data['image1'] = $imagePath;
        }

        if ($request->hasFile('image2')) {
            // Delete old image if exists
            if ($portfolioAbout->image2) {
                Storage::disk('public')->delete($portfolioAbout->image2);
            }
            $imagePath      = $request->file('image2')->store('portfolio-abouts', 'public');
            $data['image2'] = $imagePath;
        }

        $portfolioAbout->update($data);

        return redirect()->route('dashboard.portfolio-abouts.index')
            ->with('success', 'Portfolio About updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PortfolioAbout $portfolioAbout)
    {
        try {
            // Delete image files
            if ($portfolioAbout->image1) {
                Storage::disk('public')->delete($portfolioAbout->image1);
            }
            if ($portfolioAbout->image2) {
                Storage::disk('public')->delete($portfolioAbout->image2);
            }

            $portfolioAbout->delete();

            return redirect()->route('dashboard.portfolio-abouts.index')
                ->with('success', 'Portfolio About deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete portfolio about: ' . $e->getMessage()]);
        }
    }

    /**
     * Toggle portfolio about active status
     */
    public function toggleStatus(PortfolioAbout $portfolioAbout)
    {
        $portfolioAbout->update(['is_active' => ! $portfolioAbout->is_active]);

        $status = $portfolioAbout->is_active ? 'activated' : 'deactivated';
        return redirect()->back()
            ->with('success', "Portfolio About {$status} successfully.");
    }
}

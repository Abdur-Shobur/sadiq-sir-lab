<?php
namespace App\Http\Controllers;

use App\Models\Research;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $researches = Research::orderBy('order', 'asc')->orderBy('created_at', 'desc')->get();
        return view('dashboard.researches.index', compact('researches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.researches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'long_description' => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link'             => 'nullable|url',
            'is_active'        => 'boolean',
            'order'            => 'nullable|integer|min:0',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');
        $data['order']     = $request->input('order', 0);

        if ($request->hasFile('image')) {
            $imagePath     = $request->file('image')->store('researches', 'public');
            $data['image'] = $imagePath;
        }

        Research::create($data);

        return redirect()->route('dashboard.researches.index')
            ->with('success', 'Research created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Research $research)
    {
        return view('dashboard.researches.show', compact('research'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Research $research)
    {
        return view('dashboard.researches.edit', compact('research'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Research $research)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'long_description' => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link'             => 'nullable|url',
            'is_active'        => 'boolean',
            'order'            => 'nullable|integer|min:0',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($research->image) {
                Storage::disk('public')->delete($research->image);
            }
            $imagePath     = $request->file('image')->store('researches', 'public');
            $data['image'] = $imagePath;
        }

        $research->update($data);

        return redirect()->route('dashboard.researches.index')
            ->with('success', 'Research updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Research $research)
    {
        try {
            // Delete image file
            if ($research->image) {
                Storage::disk('public')->delete($research->image);
            }

            $research->delete();

            return redirect()->route('dashboard.researches.index')
                ->with('success', 'Research deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete research: ' . $e->getMessage()]);
        }
    }

    /**
     * Display a listing of active researches for public view.
     */
    public function publicIndex()
    {
        $researches = Research::active()->ordered()->get();
        return view('research', compact('researches'));
    }

    /**
     * Display the specified research for public view.
     */
    public function publicShow(Research $research)
    {
        if (! $research->is_active) {
            abort(404);
        }

        return view('research-details', compact('research'));
    }

    /**
     * Update research order
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'research_orders'   => 'required|array',
            'research_orders.*' => 'integer|exists:researches,id',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->research_orders as $index => $researchId) {
                Research::where('id', $researchId)
                    ->update(['order' => $index + 1]);
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Research order updated successfully!',
        ]);
    }
}

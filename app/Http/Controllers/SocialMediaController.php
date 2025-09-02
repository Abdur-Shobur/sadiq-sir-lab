<?php
namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialMedia = SocialMedia::orderBy('created_at', 'desc')->get();
        return view('dashboard.social-media.index', compact('socialMedia'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.social-media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'platform'  => 'required|string|max:255',
            'url'       => 'required|url|max:500',
            'is_active' => 'boolean',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        SocialMedia::create($data);

        return redirect()->route('dashboard.social-media.index')
            ->with('success', 'Social media link created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SocialMedia $socialMedia)
    {
        return view('dashboard.social-media.show', compact('socialMedia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialMedia $socialMedia)
    {
        return view('dashboard.social-media.edit', compact('socialMedia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialMedia $socialMedia)
    {
        $request->validate([
            'platform'  => 'required|string|max:255',
            'url'       => 'required|url|max:500',
            'is_active' => 'boolean',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        $socialMedia->update($data);

        return redirect()->route('dashboard.social-media.index')
            ->with('success', 'Social media link updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialMedia $socialMedia)
    {
        $socialMedia->delete();

        return redirect()->route('dashboard.social-media.index')
            ->with('success', 'Social media link deleted successfully.');
    }

}

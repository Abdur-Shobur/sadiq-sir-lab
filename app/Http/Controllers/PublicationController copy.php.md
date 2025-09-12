<?php
namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Display the publications page (single page).
     */
    public function index()
    {
        $publication = Publication::active()->first();
        return view('publications', compact('publication'));
    }

    /**
     * Show the form for editing the publication.
     */
    public function edit()
    {
        $publication = Publication::first();
        if (! $publication) {
            $publication = Publication::create([
                'content'   => '<h2>Welcome to Our Publications</h2><p>This is where you can showcase your research and publications.</p>',
                'is_active' => true,
            ]);
        }
        return view('dashboard.publications.edit', compact('publication'));
    }

    /**
     * Update the publication content.
     */
    public function update(Request $request)
    {
        $request->validate([
            'content'   => 'required|string',
            'is_active' => 'boolean',
        ]);

        $publication = Publication::first();
        if (! $publication) {
            $publication = new Publication();
        }

        $publication->content   = $request->content;
        $publication->is_active = $request->boolean('is_active');
        $publication->save();

        return redirect()->route('dashboard.publications.edit')
            ->with('success', 'Publication content updated successfully.');
    }

    /**
     * Display publications for public view (same as index).
     */
    public function publicIndex()
    {
        $publication = Publication::active()->first();
        return view('publications', compact('publication'));
    }
}

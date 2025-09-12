<?php
namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Research;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ResearchController extends Controller
{
    protected function team()
    {
        return auth()->guard('team')->user();
    }

    public function index()
    {
        abort_if(! $this->team()->hasPermission('research.view'), 403);

        $researches = Research::orderBy('created_at', 'desc')->paginate(10);
        return view('team.researches.index', compact('researches'));
    }

    public function create()
    {
        abort_if(! $this->team()->hasPermission('research.create'), 403);

        return view('team.researches.create');
    }

    public function store(Request $request)
    {
        abort_if(! $this->team()->hasPermission('research.create'), 403);

        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'long_description' => 'nullable|string',
            'link'             => 'nullable|url|max:255',
            'order'            => 'nullable|integer|min:0',
            'is_active'        => 'nullable|boolean',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        // normalize boolean
        $validated['is_active'] = $request->has('is_active');

        // handle image to public/uploads/researches
        if ($request->hasFile('image')) {
            $dir = public_path('uploads/researches');
            if (! File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            $filename = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($dir, $filename);
            $validated['image'] = 'researches/' . $filename; // model accessor expects "uploads/" prefix added at render
        }

        Research::create($validated);

        return redirect()->route('team.researches.index')
            ->with('success', 'Research created successfully.');
    }

    public function show(Research $research)
    {
        abort_if(! $this->team()->hasPermission('research.view'), 403);

        return view('team.researches.show', compact('research'));
    }

    public function edit(Research $research)
    {
        abort_if(! $this->team()->hasPermission('research.edit'), 403);

        return view('team.researches.edit', compact('research'));
    }

    public function update(Request $request, Research $research)
    {
        abort_if(! $this->team()->hasPermission('research.edit'), 403);

        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'long_description' => 'nullable|string',
            'link'             => 'nullable|url|max:255',
            'order'            => 'nullable|integer|min:0',
            'is_active'        => 'nullable|boolean',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $validated['is_active'] = $request->has('is_active');

        // handle image replace
        if ($request->hasFile('image')) {
            // delete old
            if ($research->image) {
                $oldPath = public_path('uploads/' . $research->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }
            $dir = public_path('uploads/researches');
            if (! File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            $filename = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($dir, $filename);
            $validated['image'] = 'researches/' . $filename;
        }

        $research->update($validated);

        return redirect()->route('team.researches.index')
            ->with('success', 'Research updated successfully.');
    }

    public function destroy(Research $research)
    {
        abort_if(! $this->team()->hasPermission('research.delete'), 403);

        // delete file
        if ($research->image) {
            $path = public_path('uploads/' . $research->image);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $research->delete();

        return redirect()->route('team.researches.index')
            ->with('success', 'Research deleted successfully.');
    }
}

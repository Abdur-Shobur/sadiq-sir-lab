<?php
namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')->paginate(10);
        return view('team.dashboard.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('team.dashboard.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'required|string|max:255|unique:services,slug',
            'description'      => 'required|string',
            'content'          => 'required|string',
            'icon'             => 'nullable|string|max:255',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_active'        => 'boolean',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath     = $request->file('image')->store('services', 'public');
            $data['image'] = $imagePath;
        }

        Service::create($data);

        return redirect()->route('team.services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('team.dashboard.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('team.dashboard.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'required|string|max:255|unique:services,slug,' . $service->id,
            'description'      => 'required|string',
            'content'          => 'required|string',
            'icon'             => 'nullable|string|max:255',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_active'        => 'boolean',
        ]);

        $data = $request->except(['image']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $imagePath     = $request->file('image')->store('services', 'public');
            $data['image'] = $imagePath;
        }

        $service->update($data);

        return redirect()->route('team.services.index')
            ->with('success', 'Service updated successfully.');
    }
}

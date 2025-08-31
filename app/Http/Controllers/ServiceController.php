<?php
namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('order', 'asc')->get();
        return view('dashboard.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'icon'             => 'required|string|max:255',
            'background_color' => 'required|string|max:50',
            'order'            => 'nullable|integer|min:0',
            'is_active'        => 'boolean',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');
        $data['order']     = $request->input('order', 0);

        Service::create($data);

        return redirect()->route('dashboard.services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('dashboard.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('dashboard.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'icon'             => 'required|string|max:255',
            'background_color' => 'required|string|max:50',
            'order'            => 'nullable|integer|min:0',
            'is_active'        => 'boolean',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');
        $data['order']     = $request->input('order', 0);

        $service->update($data);

        return redirect()->route('dashboard.services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        try {
            $service->delete();

            return redirect()->route('dashboard.services.index')
                ->with('success', 'Service deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete service: ' . $e->getMessage()]);
        }
    }
}

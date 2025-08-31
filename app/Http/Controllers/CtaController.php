<?php

namespace App\Http\Controllers;

use App\Models\Cta;
use Illuminate\Http\Request;

class CtaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ctas = Cta::orderBy('created_at', 'desc')->get();
        return view('dashboard.ctas.index', compact('ctas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.ctas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'subtitle'      => 'nullable|string|max:255',
            'description'   => 'required|string',
            'phone_number'  => 'required|string|max:50',
            'button_text'   => 'nullable|string|max:100',
            'is_active'     => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        Cta::create($data);

        return redirect()->route('dashboard.ctas.index')
            ->with('success', 'CTA section created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cta $cta)
    {
        return view('dashboard.ctas.show', compact('cta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cta $cta)
    {
        return view('dashboard.ctas.edit', compact('cta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cta $cta)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'subtitle'      => 'nullable|string|max:255',
            'description'   => 'required|string',
            'phone_number'  => 'required|string|max:50',
            'button_text'   => 'nullable|string|max:100',
            'is_active'     => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        $cta->update($data);

        return redirect()->route('dashboard.ctas.index')
            ->with('success', 'CTA section updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cta $cta)
    {
        $cta->delete();

        return redirect()->route('dashboard.ctas.index')
            ->with('success', 'CTA section deleted successfully!');
    }
}

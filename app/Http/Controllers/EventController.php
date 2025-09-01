<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->get();
        return view('dashboard.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        Event::create($data);

        return redirect()->route('dashboard.events.index')
            ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('dashboard.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('dashboard.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        $event->update($data);

        return redirect()->route('dashboard.events.index')
            ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        try {
            $event->delete();

            return redirect()->route('dashboard.events.index')
                ->with('success', 'Event deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete event: ' . $e->getMessage()]);
        }
    }

    /**
     * Display events for public view.
     */
    public function publicIndex()
    {
        $events = Event::active()->ordered()->get();
        return view('events', compact('events'));
    }

    /**
     * Display single event details.
     */
    public function showEvent($id)
    {
        $event = Event::active()->findOrFail($id);
        return view('event-details', compact('event'));
    }
}

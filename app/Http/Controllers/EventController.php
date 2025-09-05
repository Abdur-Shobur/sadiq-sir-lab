<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::ordered()->get();
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
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'required|date',
            'event_time' => 'required|date',
            'time' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'is_active' => 'boolean',
            'order' => 'nullable|integer|min:0',
            'status' => 'required|in:upcoming,ongoing,past',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->boolean('is_active');
        $data['order'] = $request->input('order', 0);

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        // Parse event_time
        if ($request->event_time) {
            $data['event_time'] = Carbon::parse($request->event_time);
        }

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
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'required|date',
            'event_time' => 'required|date',
            'time' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'is_active' => 'boolean',
            'order' => 'nullable|integer|min:0',
            'status' => 'required|in:upcoming,ongoing,past',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->boolean('is_active');
        $data['order'] = $request->input('order', 0);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        // Parse event_time
        if ($request->event_time) {
            $data['event_time'] = Carbon::parse($request->event_time);
        }

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
            // Delete image if exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }

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

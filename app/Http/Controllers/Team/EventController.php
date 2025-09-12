<?php
namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->paginate(10);
        return view('team.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('team.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date'  => 'required|date',
            'event_time'  => 'required|date',
            'time'        => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'is_active'   => 'boolean',
            'order'       => 'nullable|integer|min:0',
            'status'      => 'required|in:upcoming,ongoing,past',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');
        $data['order']     = $request->input('order', 0);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($data);

        return redirect()->route('team.events.index')
            ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('team.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('team.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date'  => 'required|date',
            'event_time'  => 'required|date',
            'time'        => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'is_active'   => 'boolean',
            'order'       => 'nullable|integer|min:0',
            'status'      => 'required|in:upcoming,ongoing,past',
        ]);

        $data              = $request->all();
        $data['is_active'] = $request->boolean('is_active');
        $data['order']     = $request->input('order', $event->order);

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('team.events.index')
            ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('team.events.index')
            ->with('success', 'Event deleted successfully.');
    }
}

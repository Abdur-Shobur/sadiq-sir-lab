<?php
namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Store a newly created contact message.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'subject'      => 'required|string|max:255',
            'message'      => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        try {
            ContactMessage::create([
                'name'         => $request->name,
                'email'        => $request->email,
                'phone_number' => $request->phone_number,
                'subject'      => $request->subject,
                'message'      => $request->message,
                'status'       => 'unread',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully! We will get back to you soon.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'details' => config('app.debug') ? $e->getTraceAsString() : null,
            ], 500);
        }
    }

    /**
     * Display a listing of contact messages (Admin).
     */
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        // Apply filters
        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'unread':
                    $query->unread();
                    break;
                case 'read':
                    $query->read();
                    break;
                case 'replied':
                    $query->replied();
                    break;
            }
        }

        $messages    = $query->latest()->paginate(15);
        $unreadCount = ContactMessage::unread()->count();

        return view('dashboard.contact-messages.index', compact('messages', 'unreadCount'));
    }

    /**
     * Display the specified contact message (Admin).
     */
    public function show(ContactMessage $contactMessage)
    {
        // Mark as read if unread
        if ($contactMessage->status === 'unread') {
            $contactMessage->update(['status' => 'read']);
        }

        return view('dashboard.contact-messages.show', compact('contactMessage'));
    }

    /**
     * Update the status of a contact message (Admin).
     */
    public function updateStatus(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'status'      => 'required|in:unread,read,replied',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $contactMessage->update([
            'status'      => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->back()->with('success', 'Message status updated successfully.');
    }

    /**
     * Remove the specified contact message (Admin).
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('dashboard.contact-messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}

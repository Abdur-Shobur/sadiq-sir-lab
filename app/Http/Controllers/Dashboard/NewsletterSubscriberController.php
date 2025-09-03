<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterSubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscribers = NewsletterSubscriber::orderBy('created_at', 'desc')->paginate(20);
        $stats       = [
            'total'        => NewsletterSubscriber::count(),
            'active'       => NewsletterSubscriber::active()->count(),
            'inactive'     => NewsletterSubscriber::inactive()->count(),
            'unsubscribed' => NewsletterSubscriber::unsubscribed()->count(),
        ];

        return view('dashboard.newsletter-subscribers.index', compact('subscribers', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.newsletter-subscribers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        NewsletterSubscriber::create([
            'email'         => $request->email,
            'status'        => 'active',
            'subscribed_at' => now(),
        ]);

        return redirect()->route('dashboard.newsletter-subscribers.index')
            ->with('success', 'Subscriber added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsletterSubscriber $newsletterSubscriber)
    {
        return view('dashboard.newsletter-subscribers.show', compact('newsletterSubscriber'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsletterSubscriber $newsletterSubscriber)
    {
        return view('dashboard.newsletter-subscribers.edit', compact('newsletterSubscriber'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NewsletterSubscriber $newsletterSubscriber)
    {
        $validator = Validator::make($request->all(), [
            'email'  => 'required|email|unique:newsletter_subscribers,email,' . $newsletterSubscriber->id,
            'status' => 'required|in:active,inactive,unsubscribed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['email', 'status']);

        // Update timestamps based on status
        if ($request->status === 'unsubscribed' && $newsletterSubscriber->status !== 'unsubscribed') {
            $data['unsubscribed_at'] = now();
        } elseif ($request->status === 'active' && $newsletterSubscriber->status !== 'active') {
            $data['subscribed_at']   = now();
            $data['unsubscribed_at'] = null;
        }

        $newsletterSubscriber->update($data);

        return redirect()->route('dashboard.newsletter-subscribers.index')
            ->with('success', 'Subscriber updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsletterSubscriber $newsletterSubscriber)
    {
        $newsletterSubscriber->delete();

        return redirect()->route('dashboard.newsletter-subscribers.index')
            ->with('success', 'Subscriber removed successfully.');
    }

    /**
     * Update subscriber status
     */
    public function updateStatus(Request $request, NewsletterSubscriber $newsletterSubscriber)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,unsubscribed',
        ]);

        $status = $request->status;
        $data   = ['status' => $status];

        if ($status === 'unsubscribed') {
            $data['unsubscribed_at'] = now();
        } elseif ($status === 'active') {
            $data['subscribed_at']   = now();
            $data['unsubscribed_at'] = null;
        }

        $newsletterSubscriber->update($data);

        return back()->with('success', 'Subscriber status updated successfully.');
    }

    /**
     * Export subscribers to CSV
     */
    public function export()
    {
        $subscribers = NewsletterSubscriber::orderBy('created_at', 'desc')->get();

        $filename = 'newsletter_subscribers_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($subscribers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Email', 'Status', 'Subscribed At', 'Unsubscribed At', 'Created At']);

            foreach ($subscribers as $subscriber) {
                fputcsv($file, [
                    $subscriber->id,
                    $subscriber->email,
                    $subscriber->status,
                    $subscriber->subscribed_at?->format('Y-m-d H:i:s'),
                    $subscriber->unsubscribed_at?->format('Y-m-d H:i:s'),
                    $subscriber->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Subscribe to newsletter (public method)
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ]);

        try {
            // Check if email already exists (in case of race condition)
            $existingSubscriber = NewsletterSubscriber::where('email', $request->email)->first();

            if ($existingSubscriber) {
                if ($existingSubscriber->status === 'unsubscribed') {
                    // Reactivate unsubscribed user
                    $existingSubscriber->update([
                        'status'          => 'active',
                        'subscribed_at'   => now(),
                        'unsubscribed_at' => null,
                    ]);

                    return back()->with('success', 'Welcome back! Your subscription has been reactivated.');
                } elseif ($existingSubscriber->status === 'inactive') {
                    // Reactivate inactive user
                    $existingSubscriber->update([
                        'status'          => 'active',
                        'subscribed_at'   => now(),
                        'unsubscribed_at' => null,
                    ]);

                    return back()->with('success', 'Your subscription has been reactivated!');
                } else {
                    return back()->withErrors(['email' => 'This email is already subscribed to our newsletter.']);
                }
            }

            // Create new subscriber
            NewsletterSubscriber::create([
                'email'         => $request->email,
                'status'        => 'active',
                'subscribed_at' => now(),
            ]);

            return back()->with('success', 'Thank you for subscribing to our newsletter!');

        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Sorry, something went wrong. Please try again later.']);
        }
    }
}

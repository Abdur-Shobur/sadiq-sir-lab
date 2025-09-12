@extends('layouts.team-dashboard')

@section('title', 'Contact Message Details')

@section('content')
<div>
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('team.contacts.index') }}">Contact Messages</a></li>
            <li class="breadcrumb-item active" aria-current="page">Message Details</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Contact Message Details</h4>
                    <a href="{{ route('team.contacts.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ $contact->name }}</p>
                            <p><strong>Email:</strong> <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
                            <p><strong>Phone:</strong> {{ $contact->phone ?? 'Not provided' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Subject:</strong> {{ $contact->subject }}</p>
                            <p><strong>Status:</strong>
                                <span class="badge {{ $contact->is_read ? 'bg-success' : 'bg-warning' }}">
                                    {{ $contact->is_read ? 'Read' : 'Unread' }}
                                </span>
                            </p>
                            <p><strong>Date:</strong> {{ $contact->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h6>Message:</h6>
                        <div class="border p-3 rounded">
                            {{ $contact->message }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

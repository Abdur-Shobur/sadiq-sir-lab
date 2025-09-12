<!-- resources/views/team/events/show.blade.php -->
@extends('layouts.team-dashboard')

@section('title', 'Event Details')

@section('content')
<div>
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('team.events.index') }}">Events</a></li>
            <li class="breadcrumb-item active" aria-current="page">Event Details</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header gap-2 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Event Details</h4>
                    <div class="d-flex gap-2">
                        @if(auth()->guard('team')->user()->hasPermission('event.edit'))
                        <a href="{{ route('team.events.edit', $event) }}" class="btn btn-warning"><i class="fas fa-edit"></i> <span class="d-none d-lg-inline-block">Edit</span></a>
                        @endif
                        <a href="{{ route('team.events.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> <span class="d-none d-lg-inline-block">Back</span></a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <h5 class="mb-1">{{ $event->title }}</h5>
                                @if($event->description)
                                    <div class="text-muted">{{ $event->description }}</div>
                                @endif
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Event Date:</strong> {{ $event->formatted_event_date }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Time:</strong> {{ $event->time }}
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6"><strong>Location:</strong> {{ $event->location }}</div>
                                <div class="col-md-6"><strong>Order:</strong> {{ $event->order }}</div>
                            </div>

                            <div class="mb-3">
                                <span class="me-2">Status:</span>
                                @if($event->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif

                                <span class="ms-3 me-2">Event Status:</span>
                                <span class="badge bg-{{ $event->status === 'upcoming' ? 'primary' : ($event->status === 'ongoing' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </div>

                            <div class="text-muted small">
                                <div>Created: {{ $event->created_at?->format('M d, Y h:i A') }}</div>
                                <div>Updated: {{ $event->updated_at?->format('M d, Y h:i A') }}</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            @if($event->image)
                                <div class="card h-100">
                                    <div class="card-header"><h6 class="mb-0">Event Image</h6></div>
                                    <div class="card-body text-center">
                                        <img src="{{ $event->image_url }}" alt="{{ $event->title }}" style="max-width: 100%; height: auto; border-radius: 5px;">
                                    </div>
                                </div>
                            @else
                                <div class="card h-100">
                                    <div class="card-header"><h6 class="mb-0">Event Image</h6></div>
                                    <div class="card-body text-center">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                        <p class="text-muted mt-2">No image uploaded</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

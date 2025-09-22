@extends('layouts.app')

@section('title', $event->title . ' - ' . \App\Models\Setting::getValue('site_name', 'Prof. Sadiq Laboratory'))

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
	<div class="container">
		<div class="page-title-content">
			<h2>{{ $event->title }}</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('events') }}">Events</a></li>
                    <li>{{ $event->title }}</li>
                </ul>
		</div>
	</div>
</div>
<!-- End Page Title Area -->

<!-- Start Event Details Area -->
<section class="research-details-area pb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12">
                <div class="research-details-desc">
                    <!-- Event Image -->
                    @if($event->image)
                        <div class="event-image mb-4">
                            <img src="{{ $event->image_url }}" alt="{{ $event->title }}"
                                 class="img-fluid rounded" style="width: 100%; height: 400px; object-fit: cover;">
                        </div>
                    @endif

                    <!-- Event Meta Information -->
                    <div class="event-meta mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="meta-item mb-2">
                                    <i class="fas fa-calendar-alt text-primary"></i>
                                    <strong>Event Date:</strong> {{ $event->formatted_event_date }}
                                </div>
                                <div class="meta-item mb-2">
                                    <i class="fas fa-clock text-primary"></i>
                                    <strong>Time:</strong> {{ $event->time }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="meta-item mb-2">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                    <strong>Location:</strong> {{ $event->location }}
                                </div>
                                <div class="meta-item mb-2">
                                    <span class="badge bg-{{ $event->status === 'upcoming' ? 'primary' : ($event->status === 'ongoing' ? 'warning' : 'secondary') }} fs-6">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event Description -->
                    @if($event->description)
                        <div class="event-description mb-4">
                            <h4>About This Event</h4>
                            <p class="lead">{{ $event->description }}</p>
                        </div>
                    @endif

                    <!-- Event Content (if you want to add rich content later) -->
                    <div class="event-content">
                        <h4>Event Details</h4>
                        <p>Join us for this exciting event. We look forward to seeing you there!</p>

                        @if($event->description)
                            <p>{{ $event->description }}</p>
                        @endif
                    </div>

                    <!-- Event Actions -->
                    <div class="event-actions mt-4 pt-4 border-top">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('events') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-arrow-left"></i> Back to Events
                                </a>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="share-buttons">
                                    <span class="me-2">Share:</span>
                                    <a href="#" class="btn btn-sm btn-outline-primary me-1" title="Share on Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-info me-1" title="Share on Twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-success" title="Share on LinkedIn">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4 col-md-12">
                <div class="event-sidebar">
                    <!-- Event Info Card -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Event Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="info-item mb-3">
                                <i class="fas fa-calendar-alt text-primary me-2"></i>
                                <strong>Date:</strong><br>
                                {{ $event->formatted_event_date }}
                            </div>
                            <div class="info-item mb-3">
                                <i class="fas fa-clock text-primary me-2"></i>
                                <strong>Time:</strong><br>
                                {{ $event->time }}
                            </div>
                            <div class="info-item mb-3">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                <strong>Location:</strong><br>
                                {{ $event->location }}
                            </div>
                            <div class="info-item mb-3">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                <strong>Status:</strong><br>
                                <span class="badge bg-{{ $event->status === 'upcoming' ? 'primary' : ($event->status === 'ongoing' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Related Events (if you want to add this feature later) -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Quick Links</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <a href="{{ route('events') }}" class="text-decoration-none">
                                        <i class="fas fa-list me-2"></i>All Events
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ route('home') }}" class="text-decoration-none">
                                        <i class="fas fa-home me-2"></i>Home
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ route('contact') }}" class="text-decoration-none">
                                        <i class="fas fa-envelope me-2"></i>Contact Us
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Event Details Area -->
@endsection

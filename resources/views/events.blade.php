@extends('layouts.app')

@section('title', 'Events - ' . \App\Models\Setting::getValue('site_name', 'Prof. Sadiq Laboratory'))

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
	<div class="container">
		<div class="page-title-content">
			<h2>Events</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Events</li>
                </ul>
		</div>
	</div>
</div>
<!-- End Page Title Area -->

<!-- Start Events Area -->
<section class="services-area ptb-120">
    <div class="container">
        <div class="row gy-4">
            @if($events->count() > 0)
                @foreach($events as $event)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-services-box h-100">
                        <div class="icon">
                            @if($event->image)
                                <img src="{{ $event->image_url }}" alt="{{ $event->title }}"  >
                            @else
                                <img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $event->title }}"  >

                            @endif
                        </div>

                        <h3>{{ $event->title }}</h3>
                        <p>{{ $event->description ?? 'Join us for this exciting event. More details available on the event page.' }}</p>

                        <div class="event-meta mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt"></i> {{ $event->formatted_event_date }}
                                    </small>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> {{ $event->time }}
                                    </small>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt"></i> {{ Str::limit($event->location, 30) }}
                                    </small>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <span class="badge bg-{{ $event->status === 'upcoming' ? 'primary' : ($event->status === 'ongoing' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('event.details', $event->id) }}" class="learn-more-btn">Learn More <i class="flaticon-arrow-pointing-to-right"></i></a>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="text-center py-5">
                        <h3>No Events Available</h3>
                        <p class="text-muted">Check back later for our upcoming events.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
<!-- End Events Area -->
@endsection

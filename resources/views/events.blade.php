@extends('layouts.app')

@section('title', 'Events - Labto')

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
<section class="services-area pt-3 pt-md-5">
    <div class="container">
        <div class="row">
            @if($events->count() > 0)
                @foreach($events as $event)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon">
                            @if($event->icon)
                                <i class="{{ $event->icon }}"></i>
                            @else
                                <i class="fas fa-calendar"></i>
                            @endif
                        </div>

                        <h3>{{ $event->title }}</h3>
                        <p>{{ $event->subtitle ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus.' }}</p>

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

@extends('layouts.app')

@section('title', $event->title . ' - Labto')

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
<section class="research-details-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="research-details-desc">
                    <div class="event-meta mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Published:</strong> {{ $event->created_at->format('F d, Y') }}</p>
                            </div>
                            <div class="col-md-6 text-end">
                                @if($event->icon)
                                    <div style="font-size: 48px; color: #007bff;">
                                        <i class="{{ $event->icon }}"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($event->subtitle)
                        <div class="event-subtitle mb-4">
                            <h4 class="text-muted">{{ $event->subtitle }}</h4>
                        </div>
                    @endif

                    <div class="event-content">
                        {!! $event->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Event Details Area -->
@endsection

@extends('layouts.app')

@section('title', 'Publications - ' . \App\Models\Setting::getValue('site_name', 'Prof. Sadiq Laboratory'))

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
	<div class="container">
		<div class="page-title-content">
			<h2>Publications</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Publications</li>
                </ul>
		</div>
	</div>
</div>
<!-- End Page Title Area -->

<!-- Start Publications Area -->
<section class="research-details-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="research-details-desc">
                    @if($publication)
                        {!! $publication->content !!}
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-file-alt fa-4x text-muted mb-4"></i>
                            <h3 class="text-muted">No Publications Available</h3>
                            <p class="text-muted">We're working on adding our latest publications. Please check back soon!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Publications Area -->
@endsection

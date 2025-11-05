@extends('layouts.app')

@section('title', $project->title . ' - ' . \App\Models\Setting::getValue('site_name', 'Prof. Sadiq Laboratory'))

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
	<div class="container">
		<div class="page-title-content">
			<h2>{{ $project->title }}</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('projects') }}">Projects</a></li>
                    <li>{{ $project->title }}</li>
                </ul>
		</div>
	</div>
</div>
<!-- End Page Title Area -->

<!-- Start Project Details Area -->
<section class="research-details-area ptb-120" >
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="research-details-desc">
                    @if($project->image)
                        <div class="project-image mb-4">
                            <img src="{{ asset('uploads/'.$project->image) }}"
                                 alt="{{ $project->title }}"
                                 style="max-width: 100%; height: auto; border-radius: 10px;">
                        </div>
                    @endif

                    <div class="project-meta mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Category:</strong>
                                    <span class="badge bg-primary">{{ $project->category->name }}</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Published:</strong> {{ $project->created_at->format('F d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    @if($project->subtitle)
                        <div class="project-subtitle mb-4">
                            <h4 class="text-muted">{{ $project->subtitle }}</h4>
                        </div>
                    @endif

                    <div class="project-content">
                        {!! $project->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Project Details Area -->
@endsection

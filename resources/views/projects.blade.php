@extends('layouts.app')

@section('title', 'Projects - ' . \App\Models\Setting::getValue('site_name', 'Prof. Sadiq Laboratory'))

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
	<div class="container">
		<div class="page-title-content">
			<h2>Projects</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Projects</li>
                </ul>
		</div>
	</div>
</div>
<!-- End Page Title Area -->

<!-- Start Projects Area -->
<section class="research-area ptb-120">
        <div class="container">
            <div class="row">
                @if($projects->count() > 0)
                    @foreach($projects as $project)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-research-box">
                            <div class="research-image">
                                <a href="{{ route('project.details', $project->id) }}">
                                    @if($project->image)
                                        <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}">
                                    @else
                                        <img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $project->title }}">
                                    @endif
                                </a>
                            </div>

                            <div class="research-content">
                                <span>{{ $project->category->name }}</span>
                                <h3><a href="{{ route('project.details', $project->id) }}">{{ $project->title }}</a></h3>
                                <p>{{ $project->subtitle ?? 'Enhancing Your Vision sit ametcon sec tetur adipisicing.' }}</p>
                                <a href="{{ route('project.details', $project->id) }}" class="read-more">
                                    Read More <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="text-center py-5">
                            <h3>No Projects Available</h3>
                            <p class="text-muted">Check back later for our latest research projects.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
<!-- End Projects Area -->
@endsection

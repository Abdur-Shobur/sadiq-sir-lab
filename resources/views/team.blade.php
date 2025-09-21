@extends('layouts.app')

@section('title', 'Our Team - ' . \App\Models\Setting::getValue('site_name', 'Prof. Sadiq Laboratory'))

@section('content')
<div class="page-title-area">
	<div class="container">
		<div class="page-title-content">
			<h2>Team</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Team</li>
                </ul>
		</div>
	</div>
</div>
<section class="team-area team-page ptb-120">
    <div class="container-fluid">
        {{-- Display teams by categories with sort order --}}
        @if(isset($categories) && $categories->count() > 0)
            @foreach($categories as $category)
                @if($category->teams->count() > 0)
                    <div class="team-category-row">
                    <div class=" team-category-header">
                        <h3>{{ $category->title }}</h3>
                        @if($category->description)
                        <p >{{ $category->description }}</p>
                        @endif
                    </div>
                    <div class="container-fluid">
                    <div class="row gy-4">
                        @foreach($category->teams as $team)
                            <div class=" col-lg-6  ">
                            <div class="user-card">
                                <div class="user-card-img">
                                    @if($team->image)
                                    <img src="{{ $team->image_url }}" alt="{{ $team->name }}">
                                    @else
                                        <img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $team->name }}">
                                    @endif
                                </div>
                                <div class="user-card-info">
                                    <h2>{{ $team->name }}</h2>
                                    <p><span>Designation:</span> {{ $team->designation }}</p>
                                    @if($team->specialities)
                                    <p><span>Specialties:</span>
                                     @foreach($team->specialities as $speciality)
                                    {{ $speciality }},
                                                    @endforeach</p>

                                        @endif

                                        @if($team->education)
                                        <p><span>Education:</span>
                                        @foreach($team->education as $education)
                                        {{ $education }},
                                        @endforeach</p>
                                        @endif

                                        @if($team->experience)
                                        <p><span>Experience:</span>
                                        @foreach($team->experience as $experience)
                                        {{ $experience }},
                                        @endforeach</p>
                                        @endif

                                    <p><span>Location:</span> {{ $team->address }}</p>
                                </div>
                            </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    </div>
                @endif
            @endforeach
        @endif



        {{-- Show message if no teams found --}}
        @if((!isset($categories) || $categories->count() == 0))
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h4 class="mb-1">No team members found</h4>
                        <p class="text-muted mb-0">Our team information will be available soon.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

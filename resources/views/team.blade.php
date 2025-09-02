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
<section class="team-area ptb-120">
    <div class="container">
        <div class="row">
            @if(isset($teams) && $teams->count() > 0)
                @foreach($teams as $team)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-team-member">
                            <div class="member-image">
                                @if($team->image)
                                <img src="{{ $team->image_url }}" alt="{{ $team->name }}">
                                @else
                                    <img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $team->name }}">
                                @endif

                                <a href="{{ route('team.member', $team->id) }}" class="details-btn">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>

                            <div class="member-content">
                                <h3><a href="{{ route('team.member', $team->id) }}">{{ $team->name }}</a></h3>
                                <span>{{ $team->designation }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="text-center">
                        <h3>No team members found</h3>
                        <p>Our team information will be available soon.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
